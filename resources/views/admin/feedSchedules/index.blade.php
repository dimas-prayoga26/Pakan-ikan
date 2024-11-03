@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="row">
          <div class="col-12 card">
            <div class="card-title">
              <div class="card-header">
                Jadwal Pakan
              </div>
            </div>
            <div class="card-body">
              <table class="table mt-2">
                <thead>
                  <tr>
                    <th>Pakan Ke-1</th>
                    <th>Pakan Ke-2</th>
                    <th>Pakan Ke-3</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($feedSchedules as $item)
                  <tr>
                    <td>{{ sprintf('%02d:%02d', $item->hourOne, $item->minuteOne) }} WIB</td>
                    <td>{{ sprintf('%02d:%02d', $item->hourTwo, $item->minuteTwo) }} WIB</td>
                    <td>{{ sprintf('%02d:%02d', $item->hourThree, $item->minuteThree) }} WIB</td>
                    <td><a href="{{ route('feedSchedules.edit', $item->id) }}"><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square"></i></button></a></td>
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