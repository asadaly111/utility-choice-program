<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'phone' => ['nullable', 'max:30'],
            'status' => ['required'],
            'role' => ['required', new Enum(UserRole::class)],
            'password' => ['required', 'string', 'confirmed', Password::min(6)
            ->letters()
            ->numbers()
            ->uncompromised(), ],
        ];
    }
}
