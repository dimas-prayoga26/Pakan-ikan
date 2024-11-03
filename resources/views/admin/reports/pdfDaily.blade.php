<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan Harian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        .badge {
            border-radius: 5px;
            margin-left: auto;
            line-height: 1;
            padding: 4px 7px;
            vertical-align: middle;
            font-weight: 400;
            font-size: 15px;
            border: 1px solid #ddd;
            height: fit-content !important; 
        }

        .badge-success {
            background-color: #31CE36; 
        }

        .badge-warning {
            background: #FFAD46; 
        }

        .badge-danger {
            background-color: #F25961; }

        .right-align {
            text-align: right;
            margin-top: 10px; /* Adjusts the space above the text */
        }

        .center-align {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3 class="center-align">Detail Laporan Harian</h3>
    <p class="center-align" style="margin-top: -10px">Laporan Sistem Monitoring Perangkat IoT Pakan Ikan Otomatis dan Pendeteksi</p>
    <p class="center-align" style="margin-top: -15px">Suhu Serta Kadar Air Pada Budidaya Ikan Hias</p>
    <hr>
    <table>
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
    </table>
    <p>Hasil dari laporan harian ini {{ $report->reportInformation }}.</p>
    <hr>
    <p class="right-align">Indramayu, Jawa barat {{ $report->date->format('d M Y') }}.</p>
    <footer>
        <p class="center-align" style="margin-top: 70px">Copyright © {{ $report->date->format('Y') }} By FISHY.</p>
    </footer>
</body>
</html>