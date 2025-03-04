<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Menu;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::get();
        return view('role-permission.index', compact('roles', 'permissions'));
    }

    public function givePermission(Request $request, Role $role)
    {
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        return back()->with('success', 'Permissions updated!');
    }

    public function create()
    {
        return view('role-permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('role.permission.index')->with('success', 'Role berhasil ditambahkan!');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success', 'Role berhasil dihapus!');
    }

    public function check(Request $request)
    {
        $exists = Role::where('name', $request->name)->exists();
        return response()->json(['exists' => $exists]);
    }
}
