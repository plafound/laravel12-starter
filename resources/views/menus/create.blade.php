@extends('layouts.app-v2')

@section('title', 'Tambah Menu')

@section('content')
<div class="container">
    <h3 class="mb-4"><a href="{{route('menus.index')}}"><i class="bi bi-chevron-left"></i></a>  Tambah Menu</h3>
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama menu" required>
        </div>
        <div class="mb-3">
            <label>URL</label>
            <input type="text" id="url" name="url" class="form-control" placeholder="Masukkan URL menu">
            <span id="url-error" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label>Ikon</label>
            <input type="text" name="icon" class="form-control" placeholder="Masukkan kode icon">
            <span>*lihat referensi icon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></span>
        </div>
        <div class="mb-3">
            <label>Parent Menu</label>
            <select name="parent_id" class="form-control form-select">
                <option value="">Tidak Ada</option>
                @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Permission</label>
            <input type="text" id="permission" name="permission" class="form-control" placeholder="Masukkan nama permission">
            <span id="permission-error" class="text-danger"></span>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Cek URL secara real-time
        $('#url').on('input', function() {
            let url = $(this).val().trim();
            if (url !== "" && !url.startsWith('/')) {
                url = '/' + url; // Menambahkan '/' di depan jika tidak ada
                $(this).val(url);
            }

            $.ajax({
                url: "{{ route('menus.check') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    url: url
                },
                success: function(response) {
                    if (response.url_exists) {
                        $('#url-error').text('URL sudah digunakan.');
                    } else {
                        $('#url-error').text('');
                    }
                }
            });
        });

        // Cek Permission secara real-time
        $('#permission').on('input', function() {
            let permission = $(this).val().trim();

            $.ajax({
                url: "{{ route('menus.check') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    permission: permission
                },
                success: function(response) {
                    if (response.permission_exists) {
                        $('#permission-error').text('Permission sudah digunakan.');
                    } else {
                        $('#permission-error').text('');
                    }
                }
            });
        });
    });
</script>

@endsection