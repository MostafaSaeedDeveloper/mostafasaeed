<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationService
{
    public const SUPPORTED = ['en', 'ar'];

    public function setLocale(string $locale): void
    {
        if (! in_array($locale, self::SUPPORTED, true)) {
            $locale = config('app.locale', 'en');
        }

        App::setLocale($locale);
        Session::put('locale', $locale);
    }

    public function currentLocale(): string
    {
        return Session::get('locale', config('app.locale', 'en'));
    }

    public function direction(): string
    {
        return $this->currentLocale() === 'ar' ? 'rtl' : 'ltr';
    }
}
