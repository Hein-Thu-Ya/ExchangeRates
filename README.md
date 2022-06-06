# Central Bank of Myanmar Exchange Rates API for Laravel 

## #SaveMyanmar

Modified Central Bank of Myanmar Exchange Rates API Laravel Package

Version - 1.0.0

Contact me - heinthuya12@gmail.com

Donation:

Wave Pay (Hein Thu Ya) - 09790571132


<br>

## Installation
----------
Requrie: PHP-7.4 or Higher | Laravel 8.0 or Higher
```
composer require centralbank/exchangerates
```

<br>

If you want to register it yourself, add the ServiceProvider in ``` config/app.php```:
```
'providers' => [
    Centralbank\Exchangerates\ExchangeRatesServiceProvider::class
]
```

<br>

To publish the config, run the vendor publish command:
```
php artisan vendor:publish --provider="Centralbank\Exchangerates\ExchangeRatesServiceProvider" --tag="config"
```
This will create a new config file named ``` config/exchangerates-api.php ```

<br>

API Route - ``` yourdomain.com/api/exchange-rate ```
