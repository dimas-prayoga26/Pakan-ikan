@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Laporan Sistem Harian</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Rata-rata Suhu</th>
                                        <th>Rata-rata PH</th>
                                        <th>Sisa Pakan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $report->avgTemp }} °C</td>
                                        <td>{{ $report->avgPh }}</td>
                                        <td>
                                            <span class="badge {{ $report->feedStatusBadge($feedMax) }}">
                                                {{ $report->feedStatusText($feedMax) }}
                                            </span>
                                        </td>
                                        <td>{{ $report->date->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge {{ $report->statusBadge() }}">{{ $report->status }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('report.daily', $report->id) }}" class="btn btn-sm btn-dark"><i class="fas fa-solid fa-eye"></i></a>
                                            <button class="btn btn-sm btn-danger" onclick="deleteReport({{ $report->id }})"><i class="fas fa-solid fa-trash"></i></button>
                                            <form id="delete-form-{{ $report->id }}" action="{{ route('report.destroy', $report->id) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Laporan Sistem Mingguan ({{ $weeklyReport['startOfWeek']->format('d M Y') }} - {{ $weeklyReport['endOfWeek']->format('d M Y') }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Rata-rata Suhu</th>
                                        <th>Rata-rata pH</th>
                                        <th>Rata-rata Sisa Pakan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $weeklyReport['averageTemperature'] }}</td>
                                        <td>{{ $weeklyReport['averagePh'] }}</td>
                                        <td>
                                            @if($weeklyReport['averageFeed'] !== null)
                                                <span class="badge {{ $weeklyReport['averageFeed'] > $feedMax ? 'badge-danger' : 'badge-success' }}">
                                                    {{ $weeklyReport['averageFeed'] > $feedMax ? 'Pakan Hampir Habis' : 'Pakan Tersedia' }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">Tidak Tersedia</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($weeklyReport['status'])
                                                <span class="badge {{ $weeklyReport['status'] == 'Danger' ? 'badge-danger' : ($weeklyReport['status'] == 'Warning' ? 'badge-warning' : 'badge-success') }}">
                                                    {{ $weeklyReport['status'] }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">Tidak Tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function deleteReport(reportId) {
        event.preventDefault();
        swal({
            title: "Apakah Anda yakin ingin menghapus laporan ini?",
            text: "Setelah dihapus, Anda tidak akan dapat memulihkannya!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('delete-form-' + reportId).submit();
            }
        });
    }
</script>
@endsection