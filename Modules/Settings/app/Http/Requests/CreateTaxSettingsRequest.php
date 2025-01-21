<?php
namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaxSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // تحقق من صلاحية المستخدم
    }

    public function rules()
    {
        return [
            'tax_rates' => 'required|array',
            'tax_rates.*' => 'numeric|min:0',
        ];
    }
}
