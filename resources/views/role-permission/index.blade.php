@extends('layouts.app-v2')

@section('title', 'Manajemen Role & Permission')
@section('content')
<div class="container">
    <h2>Manajemen Role & Permission</h2>
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-lg"></i> Tambah</a>
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
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus role ini?')"><i class="bi bi-trash3-fill"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection