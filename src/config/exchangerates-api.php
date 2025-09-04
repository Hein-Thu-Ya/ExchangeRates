<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Central Bank of Myanmar API URLs
    |--------------------------------------------------------------------------
    |
    | These are the official API endpoints for the Central Bank of Myanmar
    | exchange rates and currency information.
    |
    */
    'rates_api' => env('CBM_RATES_API', 'https://forex.cbm.gov.mm/api/latest'),
    'currencies_api' => env('CBM_CURRENCIES_API', 'https://forex.cbm.gov.mm/api/currencies'),

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | Configure how long the exchange rates should be cached to reduce
    | API calls to the Central Bank of Myanmar.
    |
    */
    'cache_duration' => env('CBM_CACHE_DURATION', 3600), // 1 hour in seconds
    'cache_key' => env('CBM_CACHE_KEY', 'cbm_exchange_rates'),

    /*
    |--------------------------------------------------------------------------
    | API Timeout
    |--------------------------------------------------------------------------
    |
    | Timeout for API requests in seconds.
    |
    */
    'timeout' => env('CBM_API_TIMEOUT', 30),
];
