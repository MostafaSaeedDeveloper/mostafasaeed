<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyConversionService
{
    public function toBase(float $amount, Currency $currency): float
    {
        return $amount * $currency->exchange_rate;
    }

    public function fromBase(float $amount, Currency $currency): float
    {
        return $currency->exchange_rate > 0 ? $amount / $currency->exchange_rate : $amount;
    }
}
