<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Customer;
use App\Models\Expense;
use App\Observers\AutomaticBackupObserver;

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
        Customer::observe(AutomaticBackupObserver::class);
        Expense::observe(AutomaticBackupObserver::class);
    }
}
