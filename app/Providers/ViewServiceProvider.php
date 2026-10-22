<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class ViewServiceProvider extends ServiceProvider
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
        // Share menu data with all views
        View::composer('*', function ($view) {
            $view->with('menus', Menu::getHierarchical());
        });
        
        // Share site configs with all views
        View::composer('*', function ($view) {
            $view->with('siteConfigs', \App\Models\SiteConfig::getAll());
        });
    }
}