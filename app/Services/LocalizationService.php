<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationService
{
    public const DEFAULT_LOCALE = 'en';
    public const SUPPORTED_LOCALES = ['en', 'ar'];

    public function setLocale(string $locale): void
    {
        $locale = in_array($locale, self::SUPPORTED_LOCALES, true) ? $locale : self::DEFAULT_LOCALE;
        Session::put('locale', $locale);
        App::setLocale($locale);
    }

    public function currentLocale(): string
    {
        $locale = Session::get('locale', self::DEFAULT_LOCALE);

        return in_array($locale, self::SUPPORTED_LOCALES, true) ? $locale : self::DEFAULT_LOCALE;
    }

    public function direction(): string
    {
        return $this->currentLocale() === 'ar' ? 'rtl' : 'ltr';
    }

    public function isRtl(): bool
    {
        return $this->direction() === 'rtl';
    }
}
