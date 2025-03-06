@extends('layouts.app-v2')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container">
    <h2>Manajemen Pengguna</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-lg"></i> Tambah</a>

    @if(session('success'))
    <div id="success-message" data-message="{{ session('success') }}"></div>
    @elseif(session('error'))
    <div id="error-message" data-message="{{ session('error')}}"></div>
    @endif

    <table id="users-table" class="table table-striped">
        <thead>
            <tr>
                <th style="width: 15px;">No</th>
                <th>Avatar</th>
                <th>Nama</thclass=>
                <th>Email</th>
                <th>Role</th=>
                <th>Aksi</th=>
            </tr>
        </thead>
        <!-- isian body table akan diisi oleh datatables -->
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.datatables') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'avatar',
                    name: 'avatar',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

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