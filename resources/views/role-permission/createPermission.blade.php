@extends('layouts.app-v2')

@section('title', 'Tambah Permission')

@section('content')
<div class="container">
    <h3 class="mb-4"><a href="{{route('permission.index')}}"><i class="bi bi-chevron-left"></i></a>  Tambah Permission</h3>

    <form action="{{ route('permission.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Permission</label>
            <input id="name"" type="text" name="name" class="form-control" placeholder="Masukkan nama permission" required>
            <div id="permissionNameError" class="text-danger mt-2"></div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#name').on('keyup', function () {
            let permissionName = $(this).val().trim();
            let errorDiv = $('#permissionNameError');

            if (permissionName !== '') {
                $.ajax({
                    url: "{{ route('permission.check') }}", // Route ke controller
                    method: "GET",
                    data: { name: permissionName },
                    success: function (response) {
                        if (response.exists) {
                            errorDiv.text('Nama permission sudah digunakan.');
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