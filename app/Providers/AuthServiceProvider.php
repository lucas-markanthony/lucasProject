<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('logged-in', function($user){
            return $user;
        });

        Gate::define('is-admin', function($user){
            return $user->hasAnyRole('Admin');
        });

        Gate::define('tab-records', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin']);
        });

        Gate::define('tab-cashier', function($user){
            return $user->hasAnyRoles(['Cashier','Teacher','Admin']);
        });

        Gate::define('tab-registrar', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin']);
        });

        Gate::define('tab-reports', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin','Cashier']);
        });

        //

        Gate::define('student-register', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher']);
        });

        Gate::define('student-search', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin','Cashier']);
        });

        Gate::define('student-view', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin','Cashier']);
        });

        Gate::define('student-update', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin']);
        });

        Gate::define('student-update-status', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher']);
        });

        Gate::define('record-searchclass', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin']);
        });

        Gate::define('record-searchstudent', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin']);
        });

        Gate::define('record-searchclass-update', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin']);
        });

        Gate::define('cashier-search', function($user){
            return $user->hasAnyRoles(['Teacher','Admin','Cashier']);
        });

        Gate::define('casher-pay', function($user){
            return $user->hasAnyRoles(['Teacher','Admin','Cashier']);
        });

        Gate::define('report-get', function($user){
            return $user->hasAnyRoles(['Registrar','Teacher','Admin','Cashier']);
        });
    }
}
