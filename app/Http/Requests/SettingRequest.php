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
            'brand_name' => ['required', 'string', 'max:255'],
            'site_name_en' => ['required', 'string', 'max:255'],
            'site_name_ar' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'address_en' => ['required', 'string'],
            'address_ar' => ['required', 'string'],
            'base_currency_id' => ['nullable', 'exists:currencies,id'],
            'invoice_prefix' => ['required', 'string', 'max:15'],
            'default_tax_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
