<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'password_confirmation' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'User name field is required!',
            'email.required' => 'Email field is required!',
            'password.required'  => 'Password field is required!',
            'password_confirmation.required'  => 'Password confirmation field is required!',
        ];
    }
}
