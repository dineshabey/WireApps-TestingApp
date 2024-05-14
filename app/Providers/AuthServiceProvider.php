<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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

        Gate::define('view-medication', function ($user) {
            return true; // All users can view medication records
        });

        Gate::define('view-customer', function ($user) {
            return true; // All users can view customer records
        });

        // Only the owner can perform CRUD operations and permanent deletion of records
        Gate::define('crud-medication', function ($user) {
            return $user->role === 'owner';
        });

        // Managers can update and soft delete records but cannot insert or permanently delete
        Gate::define('update-medication', function ($user) {
            return $user->role === 'manager';
        });

        Gate::define('soft-delete-medication', function ($user) {
            return $user->role === 'manager';
        });


        Gate::define('crud-customer', function ($user) {
            return $user->role === 'owner';
        });

        // Cashiers can update records but cannot insert or delete
        Gate::define('update-customer', function ($user) {
            return $user->role === 'cashier';
        });

        // Soft delete customer records
        Gate::define('soft-delete-customer', function ($user) {
            return $user->role === 'manager';
        });

        Gate::define('create-customer', function ($user) {
            return $user->role === 'owner';
        });
    }
}
