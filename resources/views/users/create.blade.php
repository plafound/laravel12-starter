@extends('layouts.app-v2')

@section('title', 'Tambah User')

@section('content')
<div class="container">
    <h3 class="mb-4"><a href="{{route('users.index')}}"><i class="bi bi-chevron-left"></i></a>  Tambah User</h3>
    <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama pengguna" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan 8-12 character" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control form-select" required>
            <option value="">Silakan pilih role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
