<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            // Ambil nama rute saat ini dan ubah menjadi format judul
            $routeName = Route::currentRouteName();
            $pageTitle = ucwords(str_replace('.', ' ', $routeName));

            // Kirim variabel pageTitle ke semua view
            $view->with('pageTitle', $pageTitle);
        });
    }
}
