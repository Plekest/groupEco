<?php

namespace App\Providers;

use App\Models\EconomicGroup;
use App\Models\Employee;
use App\Models\Flag;
use App\Models\Unit;
use App\Models\User;
use App\Observers\AuditObserver;
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
        EconomicGroup::observe(AuditObserver::class);
        Employee::observe(AuditObserver::class);
        Flag::observe(AuditObserver::class);
        Unit::observe(AuditObserver::class);
        User::observe(AuditObserver::class);
    }
}
