<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
        'userName' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|unique:users,phone',
        'role' => 'required|string',
     ];
    }
    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'phone.required' => 'The role field is required.',
            'role.required' => 'The role field is required.',

            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
            'email.exists' => 'The email does not match our records.',
           
        ];
    }

}
