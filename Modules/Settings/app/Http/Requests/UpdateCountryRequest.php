<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $countryId = $this->route('country'); // الحصول على ID البلد

        return [
        'name_en' => 'nullable|string', // إذا كان اسم البلد بالإنجليزية اختياري
        'name_ar' => 'nullable|string', // إذا كان اسم البلد بالعربية اختياري
        'dialing_code' => 'nullable|regex:/^\+\d{1,5}$/|unique:countries,dialing_code,' . $countryId, // تحقق من أن رمز الاتصال فريد إلا إذا كان هو نفسه
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'dialing_code.regex' => 'The dialing code must start with "+" followed by 1 to 5 digits.',
            'dialing_code.unique' => 'The dialing code must be unique and not already used by another country.',
       ];
    }
}
