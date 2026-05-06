<?php

namespace App\Providers;

use App\Models\PenggunaanLab;
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
        //
        View::composer('admin.partials.navbar', function ($view) {
            $notifikasiBaru = PenggunaanLab::with(['pengunjung', 'lab'])
                ->where('is_read', false)
                ->latest()
                ->take(5)
                ->get();

            $view->with('notifikasiBaru', $notifikasiBaru);
        });
    }
}
