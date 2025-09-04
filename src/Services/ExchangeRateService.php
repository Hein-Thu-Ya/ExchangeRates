<?php

namespace Centralbank\Exchangerates\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

class ExchangeRateService
{
    protected $ratesApiUrl;
    protected $currenciesApiUrl;
    protected $cacheKey;
    protected $cacheDuration;
    protected $timeout;

    public function __construct()
    {
        $this->ratesApiUrl = config('exchangerates.rates_api');
        $this->currenciesApiUrl = config('exchangerates.currencies_api');
        $this->cacheKey = config('exchangerates.cache_key');
        $this->cacheDuration = config('exchangerates.cache_duration');
        $this->timeout = config('exchangerates.timeout');
    }

    /**
     * Get all exchange rates with caching
     */
    public function getAllRates()
    {
        return Cache::remember($this->cacheKey, $this->cacheDuration, function () {
            return $this->fetchRatesFromApi();
        });
    }

    /**
     * Get exchange rate for a specific currency
     */
    public function getRate(string $currencyCode)
    {
        $rates = $this->getAllRates();
        
        if (!$rates || !isset($rates['rates'])) {
            return null;
        }

        foreach ($rates['rates'] as $rate) {
            if ($rate['symbol'] === strtoupper($currencyCode)) {
                return $rate;
            }
        }

        return null;
    }

    /**
     * Get multiple currencies by their codes
     */
    public function getRates(array $currencyCodes)
    {
        $allRates = $this->getAllRates();
        
        if (!$allRates || !isset($allRates['rates'])) {
            return [];
        }

        $uppercaseCodes = array_map('strtoupper', $currencyCodes);
        
        return array_filter($allRates['rates'], function ($rate) use ($uppercaseCodes) {
            return in_array($rate['symbol'], $uppercaseCodes);
        });
    }

    /**
     * Fetch rates from the API
     */
    protected function fetchRatesFromApi()
    {
        try {
            $ratesResponse = Http::timeout($this->timeout)->get($this->ratesApiUrl);
            $currenciesResponse = Http::timeout($this->timeout)->get($this->currenciesApiUrl);

            if (!$ratesResponse->successful() || !$currenciesResponse->successful()) {
                throw new Exception('Failed to fetch data from CBM API');
            }

            $rates = $ratesResponse->json();
            $currencies = $currenciesResponse->json();

            if (!isset($rates['rates']) || !isset($currencies['currencies'])) {
                throw new Exception('Invalid API response structure');
            }

            return $this->formatRatesData($rates, $currencies);

        } catch (Exception $e) {
            \Log::error('Exchange Rate API Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Format the rates data dynamically
     */
    protected function formatRatesData($rates, $currencies)
    {
        $formattedRates = [];

        foreach ($rates['rates'] as $currencyCode => $rate) {
            if (isset($currencies['currencies'][$currencyCode])) {
                $formattedRates[] = [
                    'rate' => $rate,
                    'currencies' => $currencies['currencies'][$currencyCode],
                    'symbol' => $currencyCode
                ];
            }
        }

        return [
            'info' => $rates['info'] ?? null,
            'description' => $rates['description'] ?? null,
            'timestamp' => $rates['timestamp'] ?? null,
            'rates' => $formattedRates
        ];
    }

    /**
     * Clear the cache
     */
    public function clearCache()
    {
        Cache::forget($this->cacheKey);
    }

    /**
     * Refresh the cache
     */
    public function refreshCache()
    {
        $this->clearCache();
        return $this->getAllRates();
    }
}
