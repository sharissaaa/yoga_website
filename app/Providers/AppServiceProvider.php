<?php

namespace App\Providers;

use App\Services\Strapi\GlobalContentService;
use Illuminate\Support\Facades\View;
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
        // The header and footer render on every page via the shared layout,
        // so their Strapi-driven content (nav links, contact info, social
        // links) is injected here rather than requiring every controller to
        // fetch it individually.
        View::composer(['partials.nav', 'partials.footer'], function ($view) {
            $global = app(GlobalContentService::class)->get();
            $view->with([
                'siteHeader' => $global['siteHeader'],
                'siteFooter' => $global['siteFooter'],
                'social' => $global['social'],
            ]);
        });
    }
}
