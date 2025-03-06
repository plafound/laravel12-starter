@extends('layouts.app-v2')

@section('title', 'Manajemen Menu')

@section('content')
<div class="container">
    <h2>Manajemen Menu</h2>
    <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-lg"></i> Tambah</a>

    @if(session('success'))
    <div id="success-message" data-message="{{ session('success') }}"></div>
    @elseif(session('error'))
    <div id="error-message" data-message="{{ session('error')}}"></div>
    @endif

    <table id="menus-table" class="table table-striped">
        <thead>
            <tr>
                <th>Urutan</th>
                <th>Nama</th>
                <th>URL</th>
                <th>Ikon</th>
                <th>Parent</th>
                <th>Permission</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->order }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{env('APP_URL')}}{{ $menu->url ?? '/#' }}</td>
                <td><i class="{{ $menu->icon }}"></i></td>
                <td>{{ $menu->parent?->name ?? '-' }}</td>
                <td>{{ $menu->permission ?? '-' }}</td>
                <td>
                    <form action="{{ route('menus.move', ['id' => $menu->id, 'direction' => 'up']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{ $menu->order == 1 ? 'disabled' : '' }}>⬆️</button>
                    </form>
                    <form action="{{ route('menus.move', ['id' => $menu->id, 'direction' => 'down']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">⬇️</button>
                    </form>
                    <form id="delete-form-{{$menu->id}}" action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$menu->id}}')"><i class="bi bi-trash3-fill"></i></button>
                    </form>
                </td>
            </tr>
            @foreach($menu->children as $submenu)
            <tr>
                <td>{{$menu->order}}-{{$submenu->order}}</td>
                <td>— {{ $submenu->name }}</td>
                <td>{{env('APP_URL')}}{{ $submenu->url }}</td>
                <td><i class="{{ $submenu->icon }}"></i></td>
                <td>{{ $menu->name }}</td>
                <td>{{ $submenu->permission ?? '-' }}</td>
                <td>
                    <form action="{{ route('menus.move', ['id' => $submenu->id, 'direction' => 'up']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{ $menu->order == 1 ? 'disabled' : '' }}>⬆️</button>
                    </form>
                    <form action="{{ route('menus.move', ['id' => $submenu->id, 'direction' => 'down']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">⬇️</button>
                    </form>
                    <form id="delete-form-{{$submenu->id}}" action="{{ route('menus.destroy', $submenu->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$submenu->id}}')"><i class="bi bi-trash3-fill"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endsection