# Central Bank of Myanmar Exchange Rates API for Laravel 

## #SaveMyanmar

Enhanced Central Bank of Myanmar Exchange Rates Laravel Package with caching, error handling, and service-based architecture.

**Version - 2.0.0**

Contact me - heinthuya12@gmail.com

Buy me a coffee - KBZ Pay (Hein Thu Ya) - 09978966317

## Features

- ✅ **Service-Based Architecture** - Clean service class for easy integration
- ✅ **Caching Support** - Reduces API calls with configurable cache duration
- ✅ **Error Handling** - Robust error handling and validation
- ✅ **Dynamic Currency Support** - Automatically supports all CBM currencies
- ✅ **Cache Management** - Manual cache refresh capability
- ✅ **Environment Configuration** - Configurable via environment variables
- ✅ **Dependency Injection** - Proper Laravel service container integration

## Requirements

- PHP 7.4 or Higher
- Laravel 8.0 or Higher (supports Laravel 8.x, 9.x, 10.x, 11.x)

## Installation

```bash
composer require centralbank/exchangerates
```

### Auto-Discovery
Laravel will automatically discover the service provider. No manual registration needed.

### Manual Registration (Optional)
If auto-discovery is disabled, add the ServiceProvider in `config/app.php`:
```php
'providers' => [
    Centralbank\Exchangerates\ExchangeRatesServiceProvider::class
]
```

### Publish Configuration
```bash
php artisan vendor:publish --tag=exchangerates-config
```
This creates `config/exchangerates-api.php` for customization.

## Configuration

The package can be configured via environment variables:

```env
# API URLs (optional - defaults to CBM official endpoints)
CBM_RATES_API=https://forex.cbm.gov.mm/api/latest
CBM_CURRENCIES_API=https://forex.cbm.gov.mm/api/currencies

# Cache settings
CBM_CACHE_DURATION=3600  # Cache duration in seconds (default: 1 hour)
CBM_CACHE_KEY=cbm_exchange_rates  # Cache key prefix

# API timeout
CBM_API_TIMEOUT=30  # Request timeout in seconds
```

## Usage Examples

### Using the Service Class

#### In Controllers
```php
use Centralbank\Exchangerates\Services\ExchangeRateService;

class YourController extends Controller
{
    protected $exchangeRateService;

    public function __construct(ExchangeRateService $exchangeRateService)
    {
        $this->exchangeRateService = $exchangeRateService;
    }

    public function getRates()
    {
        // Get all rates
        $allRates = $this->exchangeRateService->getAllRates();
        
        // Get specific currency
        $usdRate = $this->exchangeRateService->getRate('USD');
        
        // Get multiple currencies
        $rates = $this->exchangeRateService->getRates(['USD', 'EUR', 'GBP']);
        
        // Refresh cache
        $freshRates = $this->exchangeRateService->refreshCache();
        
        return response()->json($allRates);
    }
}
```

#### In Artisan Commands
```php
use Centralbank\Exchangerates\Services\ExchangeRateService;

class UpdateExchangeRatesCommand extends Command
{
    protected $signature = 'exchange:update';
    
    public function handle(ExchangeRateService $exchangeRateService)
    {
        $rates = $exchangeRateService->refreshCache();
        
        if ($rates) {
            $this->info('Exchange rates updated successfully!');
        } else {
            $this->error('Failed to update exchange rates.');
        }
    }
}
```

#### Using Facades (Optional)
You can create your own facade or use dependency injection as shown above.

## Service Methods

### `getAllRates()`
Returns all available exchange rates with caching.

### `getRate(string $currencyCode)`
Returns exchange rate for a specific currency (e.g., 'USD', 'EUR').

### `getRates(array $currencyCodes)`
Returns exchange rates for multiple currencies.

### `refreshCache()`
Clears cache and fetches fresh data from CBM API.

### `clearCache()`
Clears the cached exchange rates.

## Response Format

### All Rates Response
```json
{
    "info": "...",
    "description": "...",
    "timestamp": "...",
    "rates": [
        {
            "rate": 2100.00,
            "currencies": "US Dollar",
            "symbol": "USD"
        }
    ]
}
```

### Single Currency Response
```json
{
    "rate": 2100.00,
    "currencies": "US Dollar", 
    "symbol": "USD"
}
```

## Changelog

### v2.0.0
- Removed all API routes and endpoints
- Implemented comprehensive error handling
- Added support for specific currency queries
- Added multiple currency endpoint
- Added cache refresh functionality
- Dynamic currency support (no hardcoded currencies)
- Environment-based configuration
- Converted to service-only architecture
- Package now provides only the ExchangeRateService class
- Developers must create their own controllers/routes if needed
- Cleaner, more flexible integration approach
- Added proper dependency injection
- Enhanced documentation

### v1.0.0
- Initial release with basic functionality
