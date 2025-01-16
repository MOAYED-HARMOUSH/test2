<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            // 'email' => 'email|max:60|',
            // 'phone' => 'string|phone',
            'password' => 'required|string|min:8',
            'emailOrPhone'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
            'email.exists' => 'The email does not match our records.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 8 characters long.',
        ];
    }

}
