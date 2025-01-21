<?php
namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePolicySettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // تحقق من صلاحية المستخدم
    }

    public function rules()
    {
        return [
            'payment_policy' => 'required|string',
            'refund_policy' => 'required|string',
        ];
    }
}
