<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'titles_en' => ['nullable', 'string'],
            'titles_ar' => ['nullable', 'string'],
            'bio_en' => ['nullable', 'string'],
            'bio_ar' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
            'cv' => ['nullable', 'mimes:pdf', 'max:5120'],
            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['nullable', 'string'],
        ];
    }
}
