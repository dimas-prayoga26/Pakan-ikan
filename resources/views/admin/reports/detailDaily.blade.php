@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Laporan Harian</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Rata-rata Suhu</th>
                                    <td>{{ $report->avgTemp }} °C</td>
                                </tr>
                                <tr>
                                    <th>Rata-rata PH</th>
                                    <td>{{ $report->avgPh }}</td>
                                </tr>
                                <tr>
                                    <th>Sisa Pakan</th>
                                    <td><span class="badge {{ $report->feedStatusBadge($feedMax) }}">
                                        {{ $report->feedStatusText($feedMax) }}
                                    </span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $report->date->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><span class="badge {{ $report->statusBadge() }}">{{ $report->status }}</span></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $report->reportInformation }}</span></td>
                                </tr>
                            </table>
                            <a href="{{ route('report.daily.pdf', $report->id) }}"><button class="btn btn-sm btn-success">Print</button></a>
                            <a href="{{ route('report.index') }}"><button class="btn btn-sm btn-dark">Kembali</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection