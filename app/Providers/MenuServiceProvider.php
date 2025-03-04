<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menus = Menu::whereNull('parent_id')
                ->orderBy('order', 'asc')
                ->with(['children' => function($query) {
                    $query->orderBy('order', 'asc');
                }])->get();
            $view->with('menus', $menus);
        });
    }
}
