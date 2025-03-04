<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function (){
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'permission:dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/avatar/update', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/avatar/delete', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
});

Route::middleware(['auth', 'permission:users'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});

Route::middleware(['auth', 'permission:roles'])->group(function () {
    Route::get('/roles', [RolePermissionController::class, 'index'])->name('role.permission.index');
    Route::post('/roles/{role}/give-permission', [RolePermissionController::class, 'givePermission'])->name('roles.give-permission');
    Route::get('/roles/create', [RolePermissionController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RolePermissionController::class, 'store'])->name('roles.store');
    Route::get('/roles/check', [RolePermissionController::class, 'check'])->name('roles.check');
    Route::delete('/roles/{role}/destroy', [RolePermissionController::class, 'destroy'])->name('roles.destroy');

});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('menus', MenuController::class);
    Route::post('/menus/check', [MenuController::class, 'check'])->name('menus.check');
    Route::post('/menus/{id}/move/{direction}', [MenuController::class, 'move'])->name('menus.move');
});


Route::get('/test', function () {
    return view('template');
})->middleware(['auth']);

require __DIR__.'/auth.php';
