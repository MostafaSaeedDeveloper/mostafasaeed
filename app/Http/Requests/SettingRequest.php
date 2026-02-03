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
            'site_name_en' => ['required', 'string', 'max:255'],
            'site_name_ar' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'contact_email' => ['nullable', 'email'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'address_en' => ['nullable', 'string'],
            'address_ar' => ['nullable', 'string'],
            'default_seo_title_en' => ['nullable', 'string'],
            'default_seo_title_ar' => ['nullable', 'string'],
            'default_seo_description_en' => ['nullable', 'string'],
            'default_seo_description_ar' => ['nullable', 'string'],
            'base_currency_id' => ['nullable', 'exists:currencies,id'],
        ];
    }
}
