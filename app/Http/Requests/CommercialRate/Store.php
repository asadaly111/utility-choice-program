<?php

namespace App\Http\Requests\CommercialRate;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'supplier' => ['required', 'string'],
            'state' => ['required', 'string'],
            'commodity' => ['required', 'string'],
            'utility' => ['required', 'string'],
            'product' => ['required', 'string'],
            'start_month' => ['required', 'string'],
            'demand_size' => ['required', 'string'],
            'rate_class' => ['required', 'string'],
            'current_rate' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
