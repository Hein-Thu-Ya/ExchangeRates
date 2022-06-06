<?php

namespace Centralbank\Exchangerates\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ExchangeRatesController extends Controller
{
    public function index()
    {
        $rates_api = Http::get(config('exchangerates.rates_api'));
        $currencies_api = Http::get(config('exchangerates.currencies_api'));

        $rates = json_decode($rates_api);
        $currencies = json_decode($currencies_api);

        $rate_key = [];
        foreach ($rates->rates as $key => $value) {
            $rate_key[$key] = $key;
        }

        $data = [
            'USD' => [
                'rate' => $rates->rates->USD,
                'currencies' => $currencies->currencies->USD,
                'symbol' => $rate_key['USD']
            ],
            'JPY' => [
                'rate' => $rates->rates->JPY,
                'currencies' => $currencies->currencies->JPY,
                'symbol' => $rate_key['JPY']
            ],
            'CZK' => [
                'rate' => $rates->rates->CZK,
                'currencies' => $currencies->currencies->CZK,
                'symbol' => $rate_key['CZK']
            ],
            'THB' => [
                'rate' => $rates->rates->THB,
                'currencies' => $currencies->currencies->THB,
                'symbol' => $rate_key['THB']
            ],
            'LKR' => [
                'rate' => $rates->rates->LKR,
                'currencies' => $currencies->currencies->LKR,
                'symbol' => $rate_key['LKR']
            ],
            'NZD' => [
                'rate' => $rates->rates->NZD,
                'currencies' => $currencies->currencies->NZD,
                'symbol' => $rate_key['NZD']
            ],
            'PHP' => [
                'rate' => $rates->rates->PHP,
                'currencies' => $currencies->currencies->PHP,
                'symbol' => $rate_key['PHP']
            ],
            'KRW' => [
                'rate' => $rates->rates->KRW,
                'currencies' => $currencies->currencies->KRW,
                'symbol' => $rate_key['KRW']
            ],
            'HKD' => [
                'rate' => $rates->rates->HKD,
                'currencies' => $currencies->currencies->HKD,
                'symbol' => $rate_key['HKD']
            ],
            'BRL' => [
                'rate' => $rates->rates->BRL,
                'currencies' => $currencies->currencies->BRL,
                'symbol' => $rate_key['BRL']
            ],
            'VND' => [
                'rate' => $rates->rates->VND,
                'currencies' => $currencies->currencies->VND,
                'symbol' => $rate_key['VND']
            ],
            'CAD' => [
                'rate' => $rates->rates->CAD,
                'currencies' => $currencies->currencies->CAD,
                'symbol' => $rate_key['CAD']
            ],
            'GBP' => [
                'rate' => $rates->rates->GBP,
                'currencies' => $currencies->currencies->GBP,
                'symbol' => $rate_key['GBP']
            ],
            'RSD' => [
                'rate' => $rates->rates->RSD,
                'currencies' => $currencies->currencies->RSD,
                'symbol' => $rate_key['RSD']
            ],
            'MYR' => [
                'rate' => $rates->rates->MYR,
                'currencies' => $currencies->currencies->MYR,
                'symbol' => $rate_key['MYR']
            ],
            'DKK' => [
                'rate' => $rates->rates->DKK,
                'currencies' => $currencies->currencies->DKK,
                'symbol' => $rate_key['DKK']
            ],
            'AUD' => [
                'rate' => $rates->rates->AUD,
                'currencies' => $currencies->currencies->AUD,
                'symbol' => $rate_key['AUD']
            ],
            'SEK' => [
                'rate' => $rates->rates->SEK,
                'currencies' => $currencies->currencies->SEK,
                'symbol' => $rate_key['SEK']
            ],
            'NOK' => [
                'rate' => $rates->rates->NOK,
                'currencies' => $currencies->currencies->NOK,
                'symbol' => $rate_key['NOK']
            ],
            'ILS' => [
                'rate' => $rates->rates->ILS,
                'currencies' => $currencies->currencies->ILS,
                'symbol' => $rate_key['ILS']
            ],
            'EUR' => [
                'rate' => $rates->rates->EUR,
                'currencies' => $currencies->currencies->EUR,
                'symbol' => $rate_key['EUR']
            ],
            'RUB' => [
                'rate' => $rates->rates->RUB,
                'currencies' => $currencies->currencies->RUB,
                'symbol' => $rate_key['RUB']
            ],
            'KWD' => [
                'rate' => $rates->rates->KWD,
                'currencies' => $currencies->currencies->KWD,
                'symbol' => $rate_key['KWD']
            ],
            'INR' => [
                'rate' => $rates->rates->INR,
                'currencies' => $currencies->currencies->INR,
                'symbol' => $rate_key['INR']
            ],
            'BND' => [
                'rate' => $rates->rates->BND,
                'currencies' => $currencies->currencies->BND,
                'symbol' => $rate_key['BND']
            ],
            'CNY' => [
                'rate' => $rates->rates->CNY,
                'currencies' => $currencies->currencies->CNY,
                'symbol' => $rate_key['CNY']
            ],
            'CHF' => [
                'rate' => $rates->rates->CHF,
                'currencies' => $currencies->currencies->CHF,
                'symbol' => $rate_key['CHF']
            ],
            'ZAR' => [
                'rate' => $rates->rates->ZAR,
                'currencies' => $currencies->currencies->ZAR,
                'symbol' => $rate_key['ZAR']
            ],
            'NPR' => [
                'rate' => $rates->rates->NPR,
                'currencies' => $currencies->currencies->NPR,
                'symbol' => $rate_key['NPR']
            ],
            'KES' => [
                'rate' => $rates->rates->KES,
                'currencies' => $currencies->currencies->KES,
                'symbol' => $rate_key['KES']
            ],
            'EGP' => [
                'rate' => $rates->rates->EGP,
                'currencies' => $currencies->currencies->EGP,
                'symbol' => $rate_key['EGP']
            ],
            'BDT' => [
                'rate' => $rates->rates->BDT,
                'currencies' => $currencies->currencies->BDT,
                'symbol' => $rate_key['BDT']
            ],
            'PKR' => [
                'rate' => $rates->rates->PKR,
                'currencies' => $currencies->currencies->PKR,
                'symbol' => $rate_key['PKR']
            ],
            'KHR' => [
                'rate' => $rates->rates->KHR,
                'currencies' => $currencies->currencies->KHR,
                'symbol' => $rate_key['KHR']
            ],
            'SGD' => [
                'rate' => $rates->rates->SGD,
                'currencies' => $currencies->currencies->SGD,
                'symbol' => $rate_key['SGD']
            ],
            'SAR' => [
                'rate' => $rates->rates->SAR,
                'currencies' => $currencies->currencies->SAR,
                'symbol' => $rate_key['SAR']
            ],
            'LAK' => [
                'rate' => $rates->rates->LAK,
                'currencies' => $currencies->currencies->LAK,
                'symbol' => $rate_key['LAK']
            ],
            'IDR' => [
                'rate' => $rates->rates->IDR,
                'currencies' => $currencies->currencies->IDR,
                'symbol' => $rate_key['IDR']
            ],
        ];

        $rate_value = [];
        foreach ($data as $key => $value) {
            $rate_value[] = $value;
        }

        return response()->json([
            'info' => $rates->info,
            'description' => $rates->description,
            'timestamp' => $rates->timestamp,
            'rates' => $rate_value
        ]);
    }
}
