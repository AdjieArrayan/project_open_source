<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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

    Schema::defaultStringLength(191);
    Schema::defaultStringLength(191);
    Schema::defaultStringLength(191);
    Schema::defaultStringLength(191);

    // Ganti default collation dan charset
    Schema::defaultStringLength(191);
    \Illuminate\Support\Facades\DB::statement("SET collation_connection = 'utf8mb4_unicode_ci'");

    }
}
