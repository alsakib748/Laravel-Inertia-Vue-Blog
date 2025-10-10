<?php

namespace App\Providers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
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
        Inertia::share([
            'categories' => fn() =>
                Cache::remember(
                    'nav_categories',
                    60,
                    fn() =>
                    Category::query()
                        ->where('status', 1)
                        ->orderBy('priority', 'asc')
                        ->pluck('name', 'slug')
                )
        ]);

        // todo: e.g., in CategoryController after store/update/destroy
        // Cache::forget('nav_categories');

    }
}
