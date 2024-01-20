<?php

namespace App\Http\Requests\Api\Currencies\Exchange;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeCalculateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fromCurrency' => 'required|exists:currencies,name',
            'toCurrency' => 'required|exists:currencies,name',
            'amount' => 'required|numeric|min:0.1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
