<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'url',
        'parent_id',
        'permission',
        'order',
    ];

    // Relasi ke parent menu
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Relasi ke child menu (submenu)
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    // Relasi ke tabel permissions Spatie
    public function permissionData()
    {
        return $this->belongsTo(Permission::class, 'permission', 'name');
    }
}
