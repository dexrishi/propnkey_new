<?php


namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\FooterItem;
use App\Models\FooterCategory;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $this->forceCleanRootUrl();

        View::composer('admin.*', function ($view) {
            $view->with('canDelete', auth()->check() && auth()->user()->canDelete());
        });

        View::composer('*', function($view) {
            // Get footer categories ordered by sort field
            $footerCategories = FooterCategory::ordered()
                ->with(['footerItems' => function($query) {
                    $query->where('status', true)
                          ->orderBy('sorting', 'asc')
                          ->limit(7);
                }])
                ->get();

            // Build structured data with category name and links
            $categoriesData = $footerCategories->map(function($category) {
                return [
                    'name' => $category->name,
                    'links' => $category->footerItems
                ];
            })->filter(function($categoryData) {
                // Only include categories that have at least one link
                return $categoryData['links']->count() > 0;
            });

            // Split into top (5) and bottom (2) categories
            $topCategories = $categoriesData->take(5);
            $bottomCategories = $categoriesData->slice(5)->take(2);

            $view->with(compact('topCategories', 'bottomCategories'));
        });
    }

    /**
     * Ensure route()/url()/sitemap never emit /index.php in links.
     */
    private function forceCleanRootUrl(): void
    {
        $configured = rtrim((string) config('app.url'), '/');
        $configured = preg_replace('#/index\.php$#i', '', $configured) ?: $configured;

        if ($this->app->runningInConsole()) {
            if ($configured !== '') {
                URL::forceRootUrl($configured);
            }

            return;
        }

        $this->app->booted(function () use ($configured) {
            $request = $this->app->make('request');
            $root = preg_replace('#/index\.php$#i', '', rtrim($request->root(), '/')) ?: '';

            if ($root !== '') {
                URL::forceRootUrl($root);
                return;
            }

            if ($configured !== '') {
                URL::forceRootUrl($configured);
            }
        });
    }
}
