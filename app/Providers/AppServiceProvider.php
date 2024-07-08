<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use App\Policies\CompanyPolicy;
use Illuminate\Support\Facades\Gate;
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
        Gate::policy(Company::class, CompanyPolicy::class);

        Gate::define('view-schedule', function (User $user) {
            return $user->hasPermissionTo('view schedule');
        });
        Gate::define('edit-schedule', function (User $user) {
            return $user->hasPermissionTo('update schedule');
        });
    }
}
