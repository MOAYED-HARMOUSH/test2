<?php
namespace Modules\Settings\Services\Financial;

use Modules\Settings\Http\Requests\CreateCurrencySettingsRequest;
use Modules\Settings\Http\Requests\CreateTaxSettingsRequest;
use Modules\Settings\Http\Requests\CreateGatewaySettingsRequest;
use Modules\Settings\Http\Requests\CreateInvoiceSettingsRequest;
use Modules\Settings\Http\Requests\CreatePolicySettingsRequest;

interface IFinancialService {
    public function saveCurrencySettings(CreateCurrencySettingsRequest $request);

    public function saveTaxSettings(CreateTaxSettingsRequest $request);

    public function saveGatewaySettings(CreateGatewaySettingsRequest $request);

    public function saveInvoiceSettings(CreateInvoiceSettingsRequest $request);

    public function savePolicySettings(CreatePolicySettingsRequest $request);
}
