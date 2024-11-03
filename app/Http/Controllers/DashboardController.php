<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Device;
use App\Models\Sensor;
use App\Models\SettingData;
use Illuminate\Http\Request;
use App\Models\FeedSchedules;


class DashboardController extends Controller
{
    public function index()
    {
        $latestSensorData = Sensor::orderBy('created_at', 'desc')->first();
        $feedMax = SettingData::first()->feedMax;

        $sales = Sensor::orderBy('created_at', 'desc')->take(10)->get()->sortBy('created_at');
        
        $data1 = [
            'labels' => $sales->pluck('created_at')->map(function ($date) {
                return $date ? $date->format('H:i:s') : 'N/A';
            }),
            'datasets' => [
                [
                    'label' => 'Suhu',
                    'backgroundColor' => 'rgba(0, 0, 0, 0)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'data' => $sales->pluck('temp'),
                ],
            ],
        ];

        $data2 = [
            'labels' => $sales->pluck('created_at')->map(function ($date) {
                return $date ? $date->format('H:i:s') : 'N/A';
            }),
            'datasets' => [
                [
                    'label' => 'pH',
                    'backgroundColor' => 'rgba(0, 0, 0, 0)',
                    'borderColor' => 'rgba(0, 0, 255, 0.6)',
                    'data' => $sales->pluck('ph'),
                ],
            ],
        ];

        $nextFeedSchedule = $this->getNextFeedSchedule();

        $devices = Device::all();
        $deviceStatus = $devices->map(function ($device) {
            return [
                'deviceKey' => $device->deviceKey,
                'lastActive_at' => $device->lastActive_at,
                'isActive' => (bool) $device->isActive,
            ];
        });

        return view('admin.dashboards.index', compact('data1', 'data2', 'latestSensorData', 'nextFeedSchedule', 'feedMax', 'deviceStatus',));
    }

    private function getNextFeedSchedule()
    {
        $now = Carbon::now('Asia/Jakarta');
        $feedSchedules = FeedSchedules::all();
        $nextFeedTime = null;

        foreach ($feedSchedules as $schedule) {
            for ($i = 1; $i <= 3; $i++) {
                $hourColumn = 'hour' . ($i === 1 ? 'One' : ($i === 2 ? 'Two' : 'Three'));
                $minuteColumn = 'minute' . ($i === 1 ? 'One' : ($i === 2 ? 'Two' : 'Three'));

                $feedTime = Carbon::createFromTime($schedule->$hourColumn, $schedule->$minuteColumn, 0, 'Asia/Jakarta');

                if ($feedTime->greaterThan($now)) {
                    if (is_null($nextFeedTime) || $feedTime->lessThan($nextFeedTime)) {
                        $nextFeedTime = $feedTime;
                    }
                }
            }
        }

        return $nextFeedTime ?: 'sudah tidak ada';
    }

    public function getLatestSensorData()
{
    $latestSensorData = Sensor::orderBy('created_at', 'desc')->first();
    $feedMax = SettingData::first()->feedMax;
    $sales = Sensor::orderBy('created_at', 'desc')->take(10)->get()->sortBy('created_at');

    $data1 = [
        'labels' => $sales->pluck('created_at')->map(function ($date) {
            return $date->format('H:i:s');
        }),
        'datasets' => [
            [
                'label' => 'temp',
                'backgroundColor' => 'rgba(0, 0, 0, 0)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'data' => $sales->pluck('temp'),
            ],
        ],
    ];

    $data2 = [
        'labels' => $sales->pluck('created_at')->map(function ($date) {
            return $date->format('H:i:s');
        }),
        'datasets' => [
            [
                'label' => 'pH',
                'backgroundColor' => 'rgba(0, 0, 0, 0)',
                'borderColor' => 'rgba(0, 0, 255, 0.6)',
                'data' => $sales->pluck('ph'),
            ],
        ],
    ];

    return response()->json([
        'latestSensorData' => $latestSensorData,
        'data1' => $data1,
        'data2' => $data2,
        'feedMax' => $feedMax,
    ]);
}
}