<?php

namespace Centralbank\Exchangerates;

use Illuminate\Support\ServiceProvider;
use Centralbank\Exchangerates\Services\ExchangeRateService;

class ExchangeRatesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/exchangerates-api.php', 'exchangerates');
        
        // Register the service
        $this->app->singleton(ExchangeRateService::class, function ($app) {
            return new ExchangeRateService();
        });
    }

    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__.'/config/exchangerates-api.php' => config_path('exchangerates-api.php'),
        ], 'exchangerates-config');
    }
}
