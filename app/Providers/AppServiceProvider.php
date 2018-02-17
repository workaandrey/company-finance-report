<?php

namespace App\Providers;

use App\FinanceReport;
use App\FinanceReportProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FinanceReport::class, function ($app) {
            return new FinanceReportProvider();
        });
    }
}
