@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12 card">
                <div class="card-title">
                    <div class="card-header">
                        Koneksi Alat
                    </div>
                </div>
                <div class="card-body">
                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Key</th>
                                <th>Status</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deviceKey as $key)
                                <tr>
                                    <td >{{ $loop->iteration }}</td>
                                    <td >{{ $key->deviceKey }}</td>
                                    <td>
                                        @if($key->isActive)
                                            <span class="badge badge-success">Terhubung</span>
                                        @else
                                            <span class="badge badge-danger">Terputus</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <button type="button" class="btn btn-dark btn-sm"
                                            data-id="{{ $key->id }}" data-key="{{ $key->deviceKey }}">
                                            <i class="fas fa-pen-square"></i>
                                        </button>
                                    </td> --}}
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

