<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use App\Policies\CompanyPolicy;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') == 'acceptance') {
            URL::forceScheme('https');
        }

        Gate::policy(Company::class, CompanyPolicy::class);

        Gate::define('view-schedule', function (User $user) {
            return $user->hasPermissionTo('view schedule');
        });
        Gate::define('edit-schedule', function (User $user) {
            return $user->hasPermissionTo('update schedule');
        });

        Gate::define('invite-crew-member', function (User $user) {
            return $user->hasPermissionTo('invite crew');
        });
        Gate::define('remove-crew-member', function (User $user) {
            return $user->hasPermissionTo('remove crew');
        });
        Gate::define('view-crew', function (User $user) {
            return $user->hasPermissionTo('viewAny crew');
        });
    }
}
