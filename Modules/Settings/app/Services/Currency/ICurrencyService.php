<?php
namespace Modules\Settings\Services\Currency;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Modules\Settings\Http\Requests\CreateCountryRequest;
use Modules\Settings\Http\Requests\CreateCurrencySettingsRequest;
use Modules\Settings\Http\Requests\UpdateCountryRequest;
use UpdateCurrencyRequest;

interface ICurrencyService{
   public function addCurrency(CreateCurrencySettingsRequest $request);
    public function updateCurrency(int $id, UpdateCurrencyRequest $data);
    public function deleteCurrency(int $id);
    public function getCurrencies(array $criteria);   


}