<?php
namespace Modules\Settings\Services\Financial;

use Modules\Settings\Models\{
    CurrencySettings,
    TaxSettings,
    GatewaySettings,
    InvoiceSettings,
    PolicySettings
};
use Modules\Settings\Http\Requests\CreateCurrencySettingsRequest;
use Modules\Settings\Http\Requests\CreateTaxSettingsRequest;
use Modules\Settings\Http\Requests\CreateGatewaySettingsRequest;
use Modules\Settings\Http\Requests\CreateInvoiceSettingsRequest;
use Modules\Settings\Http\Requests\CreatePolicySettingsRequest;
use HTMLPurifier;
use HTMLPurifier_Config;

class FinancialService implements IFinancialService {
    public function saveCurrencySettings(CreateCurrencySettingsRequest $request) {
        // الحصول على البيانات المتحقق منها
        $validated = $request->validated();
        return CurrencySettings::updateOrCreate(['id' => 1], $validated);
    }

    public function saveTaxSettings(CreateTaxSettingsRequest $request) {
        // الحصول على البيانات المتحقق منها
        $validated = $request->validated();

        foreach ($validated['tax_rates'] as $countryId => $taxRate) {
            $country = TaxSettings::where('countryId', $countryId)->first();

            if (!$country) {
                TaxSettings::create([
                    'countryId' => $countryId,
                    'default_rate' => $taxRate,
                ]);
            } else {
                $country->update([
                    'default_rate' => $taxRate,
                ]);
            }
        }
    }

    public function saveGatewaySettings(CreateGatewaySettingsRequest $request) {
        // الحصول على البيانات المتحقق منها
        $validated = $request->validated();

        GatewaySettings::updateOrCreate(['id' => 1], [
            'gateway_name' => 'PayPal',
            'api_key' => $validated['api_key'],
            'secret_key' => $validated['secret_key']
        ]);
    }

    public function saveInvoiceSettings(CreateInvoiceSettingsRequest $request) {
        // الحصول على البيانات المتحقق منها
        $validated = $request->validated();

        if ($request->hasFile('invoice_template')) {
            $path = $request->file('invoice_template')->store('invoice_templates');
            $validated['logo_path'] = $path;
        }

        InvoiceSettings::updateOrCreate(['id' => 1], $validated);
    }

    public function savePolicySettings(CreatePolicySettingsRequest $request) {
        // الحصول على البيانات المتحقق منها
        $validated = $request->validated();

        // إعداد HTMLPurifier
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $validated['payment_policy'] = $purifier->purify($validated['payment_policy']);
        $validated['refund_policy'] = $purifier->purify($validated['refund_policy']);

        $policy = PolicySettings::first();

        if ($policy) {
            $policy->update($validated);
        } else {
            PolicySettings::create($validated);
        }
    }
}
