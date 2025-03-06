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

        // Permission::create(['name' => $request->permission]);

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
        // Tentukan perubahan urutan
        $newOrder = ($direction == 'up') ? $menu->order - 1 : $menu->order + 1;


        // Cari menu lain dengan urutan yang ingin ditukar
        $swapMenu = Menu::where('order', $newOrder)->first();
        if ($swapMenu) {

            // Tukar nilai order antara dua menu
            Menu::where('id', $swapMenu->id)->update(['order' => $menu->order]);
            Menu::where('id', $menu->id)->update(['order' => $newOrder]);
        }
        return redirect()->route('menus.index')->with('success', 'Urutan menu berhasil diperbarui');
    }
}
