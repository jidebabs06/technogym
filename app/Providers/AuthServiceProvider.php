<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
    * The policy mappings for the application.
    *
    * @var array<class-string, class-string>
    */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
    * Register any authentication / authorization services.
    *
    * @return void
    */
    public function boot()
    {
        $this->registerPolicies();

        //
        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->role_id == '2';
        });

        /* define a instructor user role */
        Gate::define('isInstructor', function($user) {
            return $user->role_id == '3';
        });

        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->role_id == '1';
        });
    }
}
