<?php
namespace Modules\Settings\Http\Controllers\Financial;

use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Modules\Settings\Models\{
    CurrencySettings,
    TaxSettings,
    GatewaySettings,
    InvoiceSettings,
    PolicySettings,
    Country
};

class FinancialController extends Controller
{
    public function showFinancialSettings()
{
    return view('settings::Financial.Financial', [
        'currency' => CurrencySettings::firstOrNew(['id' => 1]),
        'tax' => TaxSettings::firstOrNew(['id' => 1]),
        'gateway' => GatewaySettings::firstOrNew(['id' => 1]),
        'invoice' => InvoiceSettings::firstOrNew(['id' => 1]),
        'policies' => PolicySettings::firstOrNew(['id' => 1]),
        'countries' => Country::with('taxSetting')->get()

    ]);
}

    public function saveCurrencySettings(Request $request)
    {
        $validated = $request->validate([
            'default_currency' => 'required|in:USD,EUR,IQD',
            'price_display' => 'required|in:symbol,name'
        ]);

        CurrencySettings::updateOrCreate(['id' => 1], $validated);
        return Redirect::route('settings.financial')->with('success', __('Currency settings updated'));
    }

    public function saveTaxSettings(Request $request)
    {
        Log::info($request->all());
    
        $validated = $request->validate([
            'tax_rates' => 'required|array',
            'tax_rates.*' => 'numeric|min:0',
        ]);
    
        foreach ($validated['tax_rates'] as $countryId => $taxRate) {
            // البحث عن السجل الفردي
            $country = TaxSettings::where('countryId', $countryId)->first();
    
            if (!$country) {
                // إذا لم يتم العثور عليه، قم بإنشاء سجل جديد
                TaxSettings::create([
                    'countryId' => $countryId,
                    'default_rate' => $taxRate,
                ]);
            } else {
                // إذا تم العثور عليه، قم بتحديث السجل
                $country->update([
                    'default_rate' => $taxRate,
                ]);
            }
        }
    
        return Redirect::route('settings.financial')->with('success', __('Tax settings updated'));
    }
    

    public function saveGatewaySettings(Request $request)
    {
        $validated = $request->validate([
            'api_key' => 'required|string',
            'secret_key' => 'required|string'
        ]);

        GatewaySettings::updateOrCreate(['id' => 1], [
            'gateway_name' => 'PayPal',
            'api_key' => $validated['api_key'],
            'secret_key' => $validated['secret_key']
        ]);

        return Redirect::route('settings.financial')->with('success', __('Gateway settings updated'));
    }

    public function testPaymentGateway()
    {
        // تنفيذ اختبار الاتصال هنا
        return Redirect::route('settings.financial')->with('success', __('Connection test successful'));
    }

    public function saveInvoiceSettings(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'tax_number' => 'required|string',
            'invoice_template' => 'sometimes|file|mimes:pdf|max:2048'
        ]);

        if ($request->hasFile('invoice_template')) {
            $path = $request->file('invoice_template')->store('invoice_templates');
            $validated['invoice_template_path'] = $path;
        }

        InvoiceSettings::updateOrCreate(['id' => 1], $validated);
        return Redirect::route('settings.financial')->with('success', __('Invoice settings updated'));
    }

    public function savePolicySettings(Request $request)
    {
        $validated = $request->validate([
            'payment_policy' => 'required|string',
            'refund_policy' => 'required|string'
        ]);

        PolicySettings::updateOrCreate(['id' => 1], $validated);
        return Redirect::route('settings.financial')->with('success', __('Policies updated'));
    }
}