<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $currencyId = $this->route('currency')?->id;

        return [
            'code' => ['required', 'string', 'max:10', Rule::unique('currencies', 'code')->ignore($currencyId)],
            'symbol' => ['required', 'string', 'max:10'],
            'is_base' => ['boolean'],
            'is_enabled' => ['boolean'],
        ];
    }
}
