@extends('layouts.app-v2')

@section('title', 'Tambah Role')

@section('content')
<div class="container">
    <h3 class="mb-4"><a href="{{route('role.permission.index')}}"><i class="bi bi-chevron-left"></i></a>  Tambah Role</h3>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Role</label>
            <input id="name"" type="text" name="name" class="form-control" placeholder="Masukkan nama role" required>
            <div id="roleNameError" class="text-danger mt-2"></div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#name').on('keyup', function () {
            let roleName = $(this).val().trim();
            let errorDiv = $('#roleNameError');

            if (roleName !== '') {
                $.ajax({
                    url: "{{ route('roles.check') }}", // Route ke controller
                    method: "GET",
                    data: { name: roleName },
                    success: function (response) {
                        if (response.exists) {
                            errorDiv.text('Nama role sudah digunakan.');
                        } else {
                            errorDiv.text('');
                        }
                    }
                });
            } else {
                errorDiv.text('');
            }
        });
    });
</script>
@endsection