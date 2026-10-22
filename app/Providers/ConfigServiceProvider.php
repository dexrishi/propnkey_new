<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ConfigHelper;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('config.helper', function ($app) {
            return new ConfigHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register global helper functions
        if (!function_exists('config_get')) {
            function config_get($label, $default = null) {
                return ConfigHelper::get($label, $default);
            }
        }

        if (!function_exists('config_set')) {
            function config_set($label, $content, $type = 'text', $description = null) {
                return ConfigHelper::set($label, $content, $type, $description);
            }
        }

        if (!function_exists('site_config')) {
            function site_config($label, $default = null) {
                return ConfigHelper::get($label, $default);
            }
        }
    }
}