<?php
namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGatewaySettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // تحقق من صلاحية المستخدم
    }

    public function rules()
    {
        return [
            // 'api_key' => 'required|string',
            // 'secret_key' => 'required|string',
            // 'currency_symbol' => 'required|string|max:10',
            // 'symbol_position' => 'required|in:before,after',
            // 'thousands_separator' => 'required|string|max:1',
            // 'decimal_separator' => 'required|string|max:1',
            // 'is_active' => 'sometimes|boolean',
        ];
    }
}