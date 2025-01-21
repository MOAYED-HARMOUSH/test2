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
            'api_key' => 'required|string',
            'secret_key' => 'required|string',
        ];
    }
}
