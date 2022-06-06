<?php

namespace Centralbank\Exchangerates;

use Illuminate\Support\ServiceProvider;

class ExchangeRatesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/exchangerates-api.php', 'exchangerates');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->publishes([
            __DIR__.'/config/exchangerates-api.php' => config_path('exchangerates-api.php'),
        ]);
    }
}
