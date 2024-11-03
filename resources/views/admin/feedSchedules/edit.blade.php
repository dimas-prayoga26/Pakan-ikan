@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h3>Edit Jadwal Pakan</h3>
            </div>
            <div class="card-body">
                <form id="editForm" action="{{ route('feedSchedules.update', $feedSchedules->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label class="mb-2" for="time1">Pakan Ke-1</label>
                            <input class="form-control" type="time" name="time1" value="{{ sprintf('%02d', $feedSchedules->hourOne) }}:{{ sprintf('%02d', $feedSchedules->minuteOne) }}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="time2" class="mb-2">Pakan Ke-2</label>
                            <input class="form-control" type="time" name="time2" value="{{ sprintf('%02d', $feedSchedules->hourTwo) }}:{{ sprintf('%02d', $feedSchedules->minuteTwo) }}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="time3" class="mb-2">Pakan Ke-3</label>
                            <input class="form-control" type="time" name="time3" value="{{ sprintf('%02d', $feedSchedules->hourThree) }}:{{ sprintf('%02d', $feedSchedules->minuteThree) }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                    <a href="{{ route('feedSchedules.index') }}"><button type="button" class="btn btn-danger mt-3">Close</button></a>
                </form>
            </div>
            
            <div class="col-md-12 card">
                <div class="card-header">
                    <h4 class="card-title">Konversi format AM/PM ke format 24 Jam</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <thead class="">
                                    <tr>
                                        <th>Format AM</th>
                                        <th>Format 24 Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>12:00 AM</td>
                                        <td>00:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>01:00 AM</td>
                                        <td>01:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>02:00 AM</td>
                                        <td>02:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>03:00 AM</td>
                                        <td>03:00 WIB</td>
                                    </tr>
                                    <tr>
                                    <td>04:00 AM</td>
                                    <td>04:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>05:00 AM</td>
                                        <td>05:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>06:00 AM</td>
                                        <td>06:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>07:00 AM</td>
                                        <td>07:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>08:00 AM</td>
                                        <td>08:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>09:00 AM</td>
                                        <td>09:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>10:00 AM</td>
                                        <td>10:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>11:00 AM</td>
                                        <td>11:00 WIB</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead class="">
                                        <tr>
                                            <th>Format PM</th>
                                            <th>Format 24 Jam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12:00 PM</td>
                                            <td>12:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td>01:00 PM</td>
                                            <td>13:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td>02:00 PM</td>
                                            <td>14:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td>03:00 PM</td>
                                            <td>15:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td>04:00 PM</td>
                                            <td>16:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td>05:00 PM</td>
                                            <td>17:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td>06:00 PM</td>
                                            <td>18:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td>07:00 PM</td>
                                            <td>19:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td>08:00 PM</td>
                                            <td>20:00 WIB</td>
                                        </tr>
                                    <tr>
                                        <td>09:00 PM</td>
                                        <td>21:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>10:00 PM</td>
                                        <td>22:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td>11:00 PM</td>
                                        <td>23:00 WIB</td>
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

<!-- Tambahkan sebelum penutupan </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
@endsection

<script>
    $("#alert_demo_7").click(function (e) {
        e.preventDefault();
        swal({
            title: "Apakah ingin merubah Jadwal feed?",
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Batal",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                },
                confirm: {
                    text: "Ya, ubah!",
                    value: true,
                    visible: true,
                    className: "btn btn-success",
                    closeModal: true,
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                swal({
                    title: "Diubah!",
                    text: "Selamat, data berhasil diubah!",
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                }).then(() => {
                    $("#editForm").submit();
                });
            } else {
                swal.close();
            }
        });
    });
</script>