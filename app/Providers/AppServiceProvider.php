<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Restaurant;
use App\Observers\RestaurantObserver;
use Illuminate\Support\Facades\Auth;
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
        View::composer(['owner.*', 'user.*'], function ($view) {
            $view->with(['restaurant' => request()->route('restaurant'), 'user' => Auth::user()]);
        });
        Restaurant::observe(RestaurantObserver::class);
    }
}
