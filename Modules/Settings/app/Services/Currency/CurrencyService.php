<?php
namespace Modules\Settings\Services\Currency;

use Modules\Settings\Models\Currency;
use Illuminate\Http\Request;
use Modules\Settings\Http\Requests\CreateCurrencySettingsRequest;
use Modules\Settings\Models\CurrencySettings;
use UpdateCurrencyRequest;

class CurrencyService implements ICurrencyService {
    public function addCurrency(CreateCurrencySettingsRequest $request) {
        return CurrencySettings::create([
            'currency' => strtoupper($request->currency),
            'symbol' => $request->symbol,
            'display' => $request->display,
            'isdefault' => $request->isdefault ?? false,
            'exchangeRate' => $request->exchangeRate
        ]);
    }

    public function updateCurrency(int $id, UpdateCurrencyRequest $request) {
        $currency = CurrencySettings::findOrFail($id);
        $currency->update([
            'symbol' => $request->symbol,
            'display' => $request->display,
            'isdefault' => $request->isdefault,
            'exchangeRate' => $request->exchangeRate
        ]);
        return $currency;
    }

    public function deleteCurrency(int $id) {
        $currency = CurrencySettings::findOrFail($id);
        if ($currency->isdefault) {
            throw new \Exception(__('Cannot delete default currency'));
        }
        return $currency->delete();
    }

    public function getCurrencies(array $criteria) {
        return CurrencySettings::when($criteria['search'] ?? null, function ($query, $search) {
            $query->where('name->en', 'like', "%$search%")
                  ->orWhere('name->ar', 'like', "%$search%")
                  ->orWhere('dialing_code', 'like', "%$search%");
        })->get();  
    }
}