<?php
namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGatewaySettingsRequest extends FormRequest
{
   

    public function rules()
    {
        return [
            'api_key' => 'required|string',
            'secret_key' => 'required|string',
            'currency_symbol' => 'required|string|max:10',
            'symbol_position' => 'required|in:before,after',
            'thousands_separator' => 'required|string|max:1',
            'decimal_separator' => 'required|string|max:1',
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'api_key.required' => 'حقل مفتاح API مطلوب.',
            'secret_key.required' => 'حقل المفتاح السري مطلوب.',
            'currency_symbol.required' => 'حقل رمز العملة مطلوب.',
            'currency_symbol.max' => 'رمز العملة يجب ألا يزيد عن 10 أحرف.',
            'symbol_position.required' => 'يجب تحديد مكان ظهور رمز العملة (قبل أو بعد).',
            'symbol_position.in' => 'مكان رمز العملة يجب أن يكون "قبل" أو "بعد".',
            'thousands_separator.required' => 'فاصل الآلاف مطلوب.',
            'thousands_separator.max' => 'فاصل الآلاف يجب أن يكون حرفًا واحدًا فقط.',
            'decimal_separator.required' => 'فاصل العشرات مطلوب.',
            'decimal_separator.max' => 'فاصل العشرات يجب أن يكون حرفًا واحدًا فقط.',
            'is_active.boolean' => 'حقل "الحالة النشطة" يجب أن يكون قيمة منطقية.',
        ];
    }
}
