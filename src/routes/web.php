<?php


use Illuminate\Support\Facades\Route;
use Centralbank\Exchangerates\Http\Controllers\ExchangeRatesController;

Route::prefix('api')->group(function(){
    Route::get('exchange-rate', [ExchangeRatesController::class, 'index']);
});

