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
            'brand_name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:1024'],
            'contact_email' => ['nullable', 'email'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'tax_number' => ['nullable', 'string', 'max:100'],
            'address_en' => ['nullable', 'string'],
            'address_ar' => ['nullable', 'string'],
            'base_currency_id' => ['nullable', 'exists:currencies,id'],
            'currency_format' => ['required', 'in:symbol,code'],
            'timezone' => ['required', 'timezone'],
            'date_format' => ['required', 'in:Y-m-d,d/m/Y,m/d/Y,d M Y'],
            'invoice_prefix' => ['required', 'string', 'max:15'],
            'invoice_start_number' => ['required', 'integer', 'min:1'],
            'default_due_days' => ['required', 'integer', 'min:1', 'max:365'],
            'invoice_terms' => ['nullable', 'string'],
            'invoice_notes' => ['nullable', 'string'],
            'invoice_template' => ['required', 'in:classic,modern,minimal'],
            'tax_enabled' => ['nullable', 'boolean'],
            'default_tax_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'tax_inclusive' => ['nullable', 'boolean'],
            'allow_item_discount' => ['nullable', 'boolean'],
            'allow_invoice_discount' => ['nullable', 'boolean'],
            'invoice_email_template' => ['nullable', 'string'],
            'overdue_notifications_enabled' => ['nullable', 'boolean'],
            'default_seo_title_en' => ['nullable', 'string'],
            'default_seo_title_ar' => ['nullable', 'string'],
            'default_seo_description_en' => ['nullable', 'string'],
            'default_seo_description_ar' => ['nullable', 'string'],
        ];
    }
}
