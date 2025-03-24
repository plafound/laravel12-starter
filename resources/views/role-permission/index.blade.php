@extends('layouts.app-v2')

@section('title', 'Manajemen Role & Permission')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-lg"></i> Role</a>
        <a href="{{ route('permission.index') }}" class="btn btn-success mb-3" style="margin-inline: 10px;" ;"><i class="bi bi-person-fill-lock"></i> Manage Permission</a>
    </div>

    @if(session('success'))
    <div id="success-message" data-message="{{ session('success') }}"></div>
    @elseif(session('error'))
    <div id="error-message" data-message="{{ session('error')}}"></div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Role</th>
                <th>Permissions</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <form action="{{ route('roles.give-permission', $role->id) }}" method="POST">
                        @csrf
                        @foreach($permissions as $permission)
                        <span>|</span>
                        <label class="form-switch">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                onchange="this.form.submit()">
                            {{ $permission->name }}
                        </label>
                        @endforeach
                    </form>
                </td>
                <td>
                    <form id="delete-form-{{$role->id}}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$role->id}}')"><i class="bi bi-trash3-fill"></i></button>
                    </form>
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