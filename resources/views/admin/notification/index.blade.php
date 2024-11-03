@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Notifikasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Keterangan</th>
                                        <th>Jam</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="notification-table-body">
                                    @foreach($notifications as $notification)
                                    <tr>
                                        <td>{{ $notification->category }}</td>
                                        <td>{{ $notification->information }}</td>
                                        <td>{{ $notification->time }}</td>
                                        <td>{{ $notification->date }}</td>
                                        <td>
                                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
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
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    function fetchLatestNotifications() {
        $.ajax({
            url: '/notifications/latest',
            method: 'GET',
            success: function(data) {
                var tbody = $('#notification-table-body');
                tbody.empty();
                data.forEach(function(notification) {
                    tbody.append(`
                        <tr data-id="${notification.id}">
                            <td>${notification.category}</td>
                            <td>${notification.information}</td>
                            <td>${notification.time}</td>
                            <td>${notification.date}</td>
                            <td>
                                <form class="delete-form" data-id="${notification.id}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-dark delete-button" type="button"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    `);
                });
                attachDeleteHandlers();
            }
        });
    }

    function attachDeleteHandlers() {
        $('.delete-button').off('click').on('click', function() {
            var button = $(this);
            var form = button.closest('.delete-form');
            var id = form.data('id');

            $.ajax({
                url: `/notifications/${id}`,
                method: 'DELETE',
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        button.closest('tr').remove();
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mencoba menghapus notifikasi.');
                }
            });
        });
    }

    // Ambil notifikasi setiap 10 detik
    setInterval(fetchLatestNotifications, 3000);
    fetchLatestNotifications(); // Ambil notifikasi pertama kali
});
</script>
@endsection