@extends('layouts.app-v2')

@section('title', 'Manajemen Role & Permission')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <a href="{{ route('permission.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-lg"></i> Permission</a>
    </div>

    @if(session('success'))
    <div id="success-message" data-message="{{ session('success') }}"></div>
    @elseif(session('error'))
    <div id="error-message" data-message="{{ session('error')}}"></div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Permissions</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    @if(!$permission->is_menu)
                    <form id="delete-form-{{$permission->id}}" action="{{ route('permission.destroy', $permission->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$permission->id}}')"><i class="bi bi-trash3-fill"></i></button>
                    </form>
                    @else
                    <button type="button" class="btn btn-secondary" disabled><i class="bi bi-trash3-fill"></i></button>
                    @endif
                </td>
            </tr>
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