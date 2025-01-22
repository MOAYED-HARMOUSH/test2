<?php
namespace Modules\Settings\Http\Controllers\Financial;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Settings\Models\Country;
use Modules\Settings\Models\CurrencySettings;
use Modules\Settings\Models\GatewaySettings;
use Modules\Settings\Models\InvoiceSettings;
use Modules\Settings\Models\PolicySettings;
use Modules\Settings\Models\TaxSettings;
use Modules\Settings\Services\Financial\FinancialService;
use Modules\Settings\Http\Requests\CreateCurrencySettingsRequest;
use Modules\Settings\Http\Requests\CreateTaxSettingsRequest;
use Modules\Settings\Http\Requests\CreateGatewaySettingsRequest;
use Modules\Settings\Http\Requests\CreateInvoiceSettingsRequest;
use Modules\Settings\Http\Requests\CreatePolicySettingsRequest;

class FinancialController extends Controller
{
    protected $financialService;

    public function __construct(FinancialService $financialService)
    {
        $this->financialService = $financialService;
    }

    public function showFinancialSettings()
    {
         Log::info( GatewaySettings::all());
        return view('settings::Financial.Financial', [
            'currency' => CurrencySettings::firstOrNew(['id' => 1]),
            'tax' => TaxSettings::firstOrNew(['id' => 1]),
            'gateways' => GatewaySettings::all(),
            'invoice' => InvoiceSettings::firstOrNew(['id' => 1]),
            'policies' => PolicySettings::first(),
            'countries' => Country::with('taxSetting')->get()
        ]);
    }

    public function saveCurrencySettings(CreateCurrencySettingsRequest $request)
    {
        $this->financialService->saveCurrencySettings($request);
        return redirect()->route('settings.financial')->with('success', __('Currency settings updated'));
    }

    public function saveTaxSettings(CreateTaxSettingsRequest $request)
    {
        $this->financialService->saveTaxSettings($request);
        return redirect()->route('settings.financial')->with('success', __('Tax settings updated'));
    }

    public function saveGatewaySettings(CreateGatewaySettingsRequest $request)
    {
        Log::info($request);
        $this->financialService->saveGatewaySettings($request);
        return redirect()->route('settings.financial')->with('success', __('Gateway settings updated'));
    }

    public function saveInvoiceSettings(CreateInvoiceSettingsRequest $request)
    {
        $this->financialService->saveInvoiceSettings($request);
        return redirect()->route('settings.financial')->with('success', __('Invoice settings updated'));
    }

    public function savePolicySettings(CreatePolicySettingsRequest $request)
    {
        $this->financialService->savePolicySettings($request);
        return redirect()->route('settings.financial')->with('success', __('Policies updated successfully.'));
    }
}
