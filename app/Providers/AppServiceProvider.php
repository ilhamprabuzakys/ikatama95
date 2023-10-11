<?php

namespace App\Providers;

use App\Custom\CustomCarbon;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('date', function ($app) {
            return new CustomCarbon();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();

        Gate::define('superadmin', function (User $user) {
            return $user->role == 'superadmin';
        });
        
        Gate::define('admin', function (User $user) {
            return $user->role == 'admin';
        });
        
        Gate::define('eksekutif', function (User $user) {
            return $user->role == 'eksekutif';
        });
    }
}
