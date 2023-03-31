<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAccountStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'document' => 'nullable|mimes:jpeg,jpg,png,pdf,doc,xlsx|max:10000',
            'zip' => 'required',
            'sub_type' => 'nullable',
            'commodity' => 'required',
            'address1' => 'required',
            'address2' => 'nullable',
            'rate_class' => 'required',
            'status' => 'required',
            'contract_end_date' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zone' => 'required',
            'utility' => 'required',
            'current_rate' => 'required',
            'notes' => 'nullable',
            'account_number' => 'required',
            'annual_volume' => 'required',
            'user_id' => 'nullable',
        ];
    }
}
