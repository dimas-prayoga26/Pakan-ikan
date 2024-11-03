@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
            <div class="row">
                <div class="col-12 card">
                    <div class="card-title">
                        <div class="card-header">
                            Pengaturan Alat
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>Minimal temp</th>
                                    <th>Maksimal temp</th>
                                    <th>Minimal Kadar Ph</th>
                                    <th>Maksimal Kadar Ph</th>
                                    <th>Miksimal feed</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($settingDatas as $data)
                                <tr>
                                    <td>{{ $data->tempMin }} <span>°C</span></td>
                                    <td>{{ $data->tempMax }} <span>°C</span></td>
                                    <td>{{ $data->phMin }} </td>
                                    <td>{{ $data->phMax }} </td>
                                    <td>{{ $data->feedMax }} </td>
                                    <td>
                                        <a href="{{ route('settings.editSettings', $data->id) }}"><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square"></i></button></a>
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
@endsection