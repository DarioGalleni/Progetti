<?php

namespace App\Providers;

use App\Models\User;
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
        // Definizione della Gate 'access-admin-features'
        Gate::define('access-admin-features', function (User $user) {
            return $user->is_admin;
        });

        // Se hai una UserPolicy e vuoi che il super-admin possa sempre gestire
        // gli utenti (bypassando le policy individuali), puoi usare il metodo before nella policy.
        // UserPolicy::before(User $user, $ability) { if ($user->is_admin) { return true; } }
    }
}
