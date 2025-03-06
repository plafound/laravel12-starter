<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function table(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return $row->roles->first()->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('users.edit', $row->id) . '" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form id="delete-form-' . $row->id . '" action="' . route('users.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field("DELETE") . '
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
