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
            'titles.en' => ['required', 'array'],
            'titles.ar' => ['required', 'array'],
            'bio.en' => ['nullable', 'string'],
            'bio.ar' => ['nullable', 'string'],
            'skills' => ['nullable', 'array'],
            'profile_image' => ['nullable', 'string', 'max:255'],
            'cv_path' => ['nullable', 'string', 'max:255'],
        ];
    }
}
