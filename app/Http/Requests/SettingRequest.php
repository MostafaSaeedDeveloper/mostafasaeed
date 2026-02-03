<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name.en' => ['nullable', 'string', 'max:255'],
            'site_name.ar' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'string', 'max:255'],
            'social_links' => ['nullable', 'array'],
            'contact_info' => ['nullable', 'array'],
            'default_seo' => ['nullable', 'array'],
            'base_currency_id' => ['nullable', 'exists:currencies,id'],
        ];
    }
}
