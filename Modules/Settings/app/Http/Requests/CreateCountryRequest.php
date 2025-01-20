<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCountryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'dialing_code' => 'required|regex:/^\+\d{1,5}$/|unique:countries',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'name_en.required' => 'The country name in English is required.',
            'name_ar.required' => 'The country name in Arabic is required.',
            'dialing_code.required' => 'The dialing code is required.',
            'dialing_code.regex' => 'The dialing code must start with "+" followed by 1 to 5 digits.',
            'dialing_code.unique' => 'The dialing code must be unique and already not used.',
        ];
    }
}
