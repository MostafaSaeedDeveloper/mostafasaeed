<?php

namespace App\Services;

class CurrencyConversionService
{
    public function convertToBase(float $amount, float $exchangeRate): float
    {
        return round($amount * $exchangeRate, 2);
    }
}
