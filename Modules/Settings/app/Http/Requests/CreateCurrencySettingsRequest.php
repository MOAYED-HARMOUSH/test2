<?php
namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCurrencySettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // هنا يجب التأكد أن المستخدم مصرح له بالقيام بهذا الإجراء
    }

    public function rules()
    {
        return [
            'default_currency' => 'required|in:USD,EUR,IQD',
            'price_display' => 'required|in:symbol,name',
        ];
    }
}
