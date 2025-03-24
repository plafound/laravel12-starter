<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->get();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $menus = Menu::whereNull('parent_id')->get();
        return view('menus.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string|unique:menus,url',
            'permission' => 'required|string|unique:permissions,name',
        ], [
            'url.unique' => 'URL sudah digunakan.',
            'permission.unique' => 'Permission sudah digunakan.',
        ]);

        // Tambahkan '/' di awal URL jika belum ada
        $url = $request->url;
        if (!str_starts_with($url, '/')) {
            $url = '/' . $url;
        }

        Permission::create(['name' => $request->permission, 'guard_name' => 'web', 'is_menu' => true]);

        // Tentukan urutan menu berdasarkan urutan terbesar
        if ($request->parent_id == null) {
            $orderMax = Menu::whereNull('parent_id')->max('order');
        } else {
            $orderMax = Menu::where('parent_id', $request->parent_id)->max('order');
        }
        $order = $orderMax + 1;
        $data = [
            'name' => $request->name,
            'url' => $url,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
            'permission' => $request->permission,
            'order' => $order,
        ];
        Menu::create($data);
        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }


    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request, Menu $menu)
    {
        //
    }


    public function destroy(Menu $menu)
    {
        $menu->delete();
        Permission::where('name', $menu->permission)->delete();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }

    public function check(Request $request)
    {
        $urlExists = Menu::where('url', $request->url)->exists();
        $permissionExists = Permission::where('name', $request->permission)->exists();

        return response()->json([
            'url_exists' => $urlExists,
            'permission_exists' => $permissionExists,
        ]);
    }

    public function move($id, $direction)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan');
        }
    
        // Cek parent_id agar pemindahan hanya dalam level yang sama
        $parentId = $menu->parent_id;
    
        // Cek batas atas & bawah dalam parent yang sama
        $query = Menu::where('parent_id', $parentId);
    
        if ($direction == 'up' && $query->min('order') == $menu->order) {
            return redirect()->back()->with('error', 'Menu sudah di posisi teratas dalam parent ini');
        }
        if ($direction == 'down' && $query->max('order') == $menu->order) {
            return redirect()->back()->with('error', 'Menu sudah di posisi terbawah dalam parent ini');
        }
    
        // Tentukan order baru
        $newOrder = ($direction == 'up') ? $menu->order - 1 : $menu->order + 1;
    
        // Cari menu lain dengan urutan yang ingin ditukar dalam parent yang sama
        $swapMenu = Menu::where('parent_id', $parentId)->where('order', $newOrder)->first();
    
        if ($swapMenu) {
            // Swap nilai order
            $swapMenu->update(['order' => $menu->order]);
            $menu->update(['order' => $newOrder]);
        }
    
        return redirect()->route('menus.index')->with('success', 'Urutan menu berhasil diperbarui');
    }
}
