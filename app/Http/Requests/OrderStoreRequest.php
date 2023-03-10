<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'poFile' => ['required'],
            'dstFile' => ['required'],
            'runSheetFile' => ['required'],
            'comments' => ['nullable'],
        ];
    }
}
