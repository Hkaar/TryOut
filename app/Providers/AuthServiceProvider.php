<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->checkRole('admin');
        });

        Gate::define('operator', function (User $user) {
            return $user->checkRole('operator');
        });

        Gate::define('student', function (User $user) {
            return $user->checkRole('student');
        });

        Gate::define('access-dashboard', function (User $user) {
            return $user->checkRole(['admin', 'operator']);
        });
    }
}
