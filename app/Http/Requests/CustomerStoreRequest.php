<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'document' => 'required|mimes:jpeg,jpg,png,pdf,doc,xlsx|max:10000',
            'first_name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'email' => 'required|email',
            'phone.*.id' => 'nullable',
            'phone.*.type' => 'nullable',
            'phone.*.value' => 'required',
            'business_name' => 'required',
            'doing_business_as' => 'required',
            'business_type' => 'required',
            'ein' => 'required|integer',
            'industry' => 'required',
            'tax_exempt' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'billing_address_option' => 'required',
            'billing_address' => 'nullable',
            'billing_state' => 'nullable',
            'billing_city' => 'nullable',
            'billing_zip' => 'nullable',
        ];
    }
}
