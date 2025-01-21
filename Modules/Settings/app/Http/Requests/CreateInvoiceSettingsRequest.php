<?php
namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // تحقق من صلاحية المستخدم
    }

    public function rules()
    {
        return [
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'tax_number' => 'required|string',
            'invoice_template' => 'sometimes|file|mimes:pdf|max:2048',
        ];
    }
}
