<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Customer;
use App\Models\Expense;
use App\Observers\AutomaticBackupObserver;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Se siamo online su Netsons (production), la cartella public è ../public_html/gest
        if ($this->app->environment('production')) {
            $this->app->instance('path.public', base_path('../public_html/gest'));
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Customer::observe(AutomaticBackupObserver::class);
        Expense::observe(AutomaticBackupObserver::class);
    }
}
