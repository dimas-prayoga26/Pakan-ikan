<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Report;
use App\Models\Sensor;
use App\Models\SettingData;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();
        $feedMax = SettingData::first()->feedMax;
        $weeklyReport = $this->getWeeklyReportData();

        return view('admin.reports.index', compact('reports', 'feedMax', 'weeklyReport'));
    }

    public function dailyReportDetail($id)
    {
        $report = Report::findOrFail($id);
        $feedMax = SettingData::first()->feedMax;
        return view('admin.reports.detailDaily', compact('report','feedMax'));
    }

    public function generateReport()
    {
        $today = Carbon::today('Asia/Jakarta');
        $sensors = Sensor::whereDate('created_at', $today)->get();

        $averageTemperature = $sensors->avg('temp');
        $averagePh = $sensors->avg('ph');
        $averageFeed = $sensors->avg('feed');

        $settings = SettingData::first();
        $tempMin = $settings->tempMin;
        $tempMax = $settings->tempMax;
        $phMin = $settings->phMin;
        $phMax = $settings->phMax;
        $feedMax = $settings->feedMax;

        $status = 'Safe';
        $warningCount = 0;
        $reportInformation = '';

        if ($averageTemperature > $tempMax || $averageTemperature < $tempMin) {
            $warningCount++;
            $reportInformation .= 'temp dari aquarium tidak stabil.';
        }

        if ($averagePh > $phMax || $averagePh < $phMin) {
            $warningCount++;
            $reportInformation .= 'PH dari aquarium tidak stabil.';
        }

        if ($averageFeed > $feedMax) {
            $warningCount++;
            $reportInformation .= 'Pakan hampir habis isi kembali tabung pakan.';
        }

        if ($warningCount >= 2) {
            $status = 'Danger';
            $reportInformation = 'temp dan PH tidak stabil!';
        } elseif ($warningCount == 1) {
            $status = 'Warning';
        } elseif ($warningCount == 0) {
            $reportInformation = 'Aman aja semuanya stabil';
        }

        $report = new Report();
        $report->avgTemp = $averageTemperature;
        $report->avgPh = $averagePh;
        $report->avgFeed = $averageFeed;
        $report->status = $status;
        $report->date = $today;
        $report->reportInformation = $reportInformation;
        $report->save();

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dihasilkan');
    }

    public function destroy($id)
    {
        $report = Report::find($id);
        if ($report) {
            $report->delete();
            return redirect()->route('report.index')->with('success', 'Laporan berhasil dihapus');
        }
        return redirect()->route('report.index')->with('error', 'Laporan tidak ditemukan');
    }
    private function getWeeklyReportData()
    {
        $endOfWeek = Carbon::now('Asia/Jakarta');
        $startOfWeek = $endOfWeek->copy()->subDays(7);

        $reports = Report::whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        // Debugging output
        // dd($reports);

        $averageTemperature = $reports->avg('avgTemp');
        $averagePh = $reports->avg('avgPh');
        $averageFeed = $reports->avg('avgFeed') ?? 0; // Default to 0 if null

        // Debugging output
        // dd($averageFeed);

        $settings = SettingData::first();
        $tempMin = $settings->tempMin;
        $tempMax = $settings->tempMax;
        $phMin = $settings->phMin;
        $phMax = $settings->phMax;
        $feedMax = $settings->feedMax;

        // Debugging output
        // dd($feedMax);

        $status = 'Safe';
        $warningCount = 0;

        if ($averageTemperature > $tempMax || $averageTemperature < $tempMin) {
            $warningCount++;
        }

        if ($averagePh > $phMax || $averagePh < $phMin) {
            $warningCount++;
        }

        if ($averageFeed > $feedMax) {
            $warningCount++;
        }

        if ($warningCount >= 2) {
            $status = 'Danger';
        } elseif ($warningCount == 1) {
            $status = 'Warning';
        }

        // Debugging output
        // dd($status);

        return [
            'averageTemperature' => $averageTemperature,
            'averagePh' => $averagePh,
            'averageFeed' => $averageFeed,
            'status' => $status,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek
        ];
    }

    public function downloadPdf($id)
    {
        $report = Report::findOrFail($id);
        $feedMax = SettingData::first()->feedMax;

        $pdf = Pdf::loadView('admin.reports.pdfDaily', compact('report', 'feedMax'));
        return $pdf->download('daily_report_'.$report->date->format('Ymd').'.pdf');
    }
    
}

