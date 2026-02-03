<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email'],
            'service' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:2000'],
            'website' => ['nullable', 'string', 'max:10'],
        ];
    }
}
