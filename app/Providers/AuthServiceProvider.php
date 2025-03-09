<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Sinistre;
use App\Models\User;

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
        Gate::define('view-sinistre', function (User $user, Sinistre $sinistre) {
            return $user->id === $sinistre->user_id || $user->isAdmin();
        });

        Gate::define('update-sinistre', function (User $user, Sinistre $sinistre) {
            return $user->id === $sinistre->user_id || $user->isAdmin();
        });
    }
} 