<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_en' => ['required', 'string', 'max:255'],
            'title_ar' => ['required', 'string', 'max:255'],
            'short_description_en' => ['nullable', 'string'],
            'short_description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:80'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:published,draft'],
            'seo_title_en' => ['nullable', 'string'],
            'seo_title_ar' => ['nullable', 'string'],
            'seo_description_en' => ['nullable', 'string'],
            'seo_description_ar' => ['nullable', 'string'],
        ];
    }
}
