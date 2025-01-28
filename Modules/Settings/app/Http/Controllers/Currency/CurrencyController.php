<?php
namespace Modules\Settings\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use Modules\Settings\Services\Currency\ICurrencyService;
use Modules\Settings\Http\Requests\CreateCurrencyRequest;
use Modules\Settings\Http\Requests\UpdateCurrencyRequest;
use Illuminate\Http\Request;
use Modules\Settings\Http\Requests\CreateCurrencySettingsRequest;
use Modules\Settings\Services\Currency\CurrencyService;
use UpdateCurrencyRequest as GlobalUpdateCurrencyRequest;

class CurrencyController extends Controller {
    protected CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService) {
        $this->currencyService = $currencyService;
    }

    public function index(Request $request) {
        $currencies = $this->currencyService->getCurrencies($request->all());

        return $request->expectsJson() 
            ? $this->successResponse($currencies)
            : view('settings::currency.currency', compact('currencies'));
    }

    public function store(CreateCurrencySettingsRequest $request) {
        $currency = $this->currencyService->addCurrency($request);
        return $request->expectsJson()
            ? $this->successResponse($currency)
            : redirect()->route('settings.currencies.index')->with('success', __('Currency added'));
    }

    public function update(GlobalUpdateCurrencyRequest $request, $id) {
        $currency = $this->currencyService->updateCurrency($id, $request);
        return $request->expectsJson()
            ? $this->successResponse($currency)
            : redirect()->route('settings.currencies.index')->with('success', __('Currency updated'));
    }

    public function destroy(Request $request, $id) {
        $this->currencyService->deleteCurrency($id);
        return $request->expectsJson()
            ? $this->successResponse(null, 204)
            : redirect()->route('settings.currencies.index')->with('success', __('Currency deleted'));
    }
}