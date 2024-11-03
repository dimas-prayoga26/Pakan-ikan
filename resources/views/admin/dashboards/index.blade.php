@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="fw-bold">Dashboard</h3>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('generate-report') }}"><button class="btn btn-primary">Generate Report</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fas fa-thermometer-half"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Suhu</p>
                                    <h4 class="card-title" id="temp"><span>{{ $latestSensorData->temp }}</span><span> °C</span> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-tint"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Kadar Air</p>
                                    <h4 class="card-title" id="ph"><span>{{ $latestSensorData->ph }}</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-battery-full"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah pakan</p>
                                    <h4 class="card-title" id="feed">
                                        @if($latestSensorData->feed > $feedMax)
                                            <span class="badge badge-danger">Segera isi Pakan!</span>
                                        @else
                                            <span class="badge badge-success">Pakan tersedia</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jadwal Pakan Selanjutnya</p>
                                    <h4 class="card-title">
                                        @if($nextFeedSchedule === 'sudah tidak ada')
                                            <span>Sudah tidak ada</span>
                                        @elseif($nextFeedSchedule)
                                            <span>{{ $nextFeedSchedule->format('H:i') }} WIB</span>
                                        @else
                                            <span>Jadwal tidak tersedia</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-cogs"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Status Alat</p>
                                    <h4 class="card-title">
                                        @foreach ($deviceStatus as $device)
                                            <span class="badge {{ $device['isActive'] ? 'badge-success' : 'badge-danger' }}">
                                                {{ $device['isActive'] ? 'Terhubung' : 'Terputus' }}
                                            </span>
                                        @endforeach
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Grafik Suhu</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="myChart" height="100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Grafik Kadar PH</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="myChartPh" height="100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tempCtx = document.getElementById('myChart').getContext('2d');
        var phCtx = document.getElementById('myChartPh').getContext('2d');
        
        var tempChart = new Chart(tempCtx, {
            type: 'line',
            data: @json($data1),
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        var phChart = new Chart(phCtx, {
            type: 'line',
            data: @json($data2),
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    
        function fetchLatestData() {
            $.ajax({
                url: '/get-latest-sensor-data',
                method: 'GET',
                success: function (response) {
                    $('#temp span').first().text(response.latestSensorData.temp);
                    $('#ph span').first().text(response.latestSensorData.ph);
    
                    if (response.latestSensorData.feed > 9) {
                        $('#feed span.badge').text('Segera isi pakan!').removeClass('badge-success').addClass('badge-danger');
                    } else {
                        $('#feed span.badge').text('Pakan tersedia').removeClass('badge-danger').addClass('badge-success');
                    }
    
                    tempChart.data.labels = response.data1.labels;
                    tempChart.data.datasets[0].data = response.data1.datasets[0].data;
                    tempChart.update();
    
                    phChart.data.labels = response.data2.labels;
                    phChart.data.datasets[0].data = response.data2.datasets[0].data;
                    phChart.update();
                }
            });
        }
    
        setInterval(fetchLatestData, 5000); // Memanggil fetchLatestData setiap 5 detik
    });
    </script>
@endsection