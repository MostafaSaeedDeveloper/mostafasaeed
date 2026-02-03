<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\App;

trait HasTranslations
{
    public function getTranslated(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?: App::getLocale();
        $value = $this->{$field} ?? [];

        if (!is_array($value)) {
            $value = json_decode((string) $value, true) ?: [];
        }

        return $value[$locale] ?? $value['en'] ?? null;
    }
}
