<?php

namespace App\Providers;

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
        if (app()->environment('production')) {
            URL::forceScheme('https');

            $sqlite = database_path('database.sqlite');

            if (file_exists($sqlite) && is_writable(dirname($sqlite))) {
                @chmod($sqlite, 0666);  // Read/write for all users
            }

        }
    }
}
