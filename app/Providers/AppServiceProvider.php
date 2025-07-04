<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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
        // Optional: enforce the locale pattern globally
        Route::pattern('locale', 'en|es|fr|ur');

        // Set default for all routes
        URL::defaults(['locale' => app()->getLocale()]);
    }
}
