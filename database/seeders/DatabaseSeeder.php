<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'avatar' => null,
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => bcrypt('password'),
            'avatar' => null,
        ]);


        // Menu utama
        $dashboard = Menu::create([
            'name' => 'Dashboard',
            'icon' => 'bi bi-grid-fill',
            'url' => '/dashboard',
            'permission' => 'dashboard',
            'parent_id' => null,
            'order' => 1,
        ]);
        $setting = Menu::create([
            'name' => 'Setting',
            'icon' => 'bi bi-gear-fill',
            'url' => null,
            'permission' => 'setting',
            'parent_id' => null,
            'order' => 2,
        ]);

        // Submenu dari Setting
        Menu::create([
            'name' => 'Role Management',
            'icon' => 'bi bi-shield-fill',
            'url' => '/roles',
            'permission' => 'roles',
            'parent_id' => $setting->id,
            'order' => 1,
        ]);
        Menu::create([
            'name' => 'User Management',
            'icon' => 'bi bi-people-fill',
            'url' => '/users',
            'permission' => 'users',
            'parent_id' => $setting->id,
            'order' => 2,
        ]);
        Menu::create([
            'name' => 'Menu Management',
            'icon' => 'bi bi-menu-app',
            'url' => '/menus',
            'permission' => 'menus',
            'parent_id' => $setting->id,
            'order' => 3,
        ]);

        $permissions = ['dashboard', 'setting', 'roles', 'users', 'menus'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web', 'is_menu' => true]);
        }


        //buat role
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions('roles','dashboard');
        $adminRole->save();
        $userRole = Role::where('name', 'user')->first();
        $userRole->syncPermissions('dashboard');
        $userRole->save();


        $admin = User::where('email', 'admin@mail.com')->first();
        $admin->assignRole('admin');
        $admin->save();
        $user = User::where('email', 'user@mail.com')->first();
        $user->assignRole('user');
        $user->save();
    }
}
