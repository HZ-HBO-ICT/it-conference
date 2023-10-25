<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
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
        Paginator::defaultView('components/pagination');
        Paginator::defaultSimpleView('components/pagination');

        RateLimiter::for('uploads', function (Request $request) {
            return Limit::perDay(2)->by($request->user()?->id ?: $request->ip())->response(function () {
                return redirect(route('contact'))->with('failure', 'Too many attempts! You are allowed to send 2 requests per day.');
            });
        });
    }
}
