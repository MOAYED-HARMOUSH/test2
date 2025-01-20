<?php
namespace Modules\Settings\Services\Country;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Modules\Settings\Http\Requests\CreateCountryRequest;
use Modules\Settings\Http\Requests\UpdateCountryRequest;

interface ICountryService{
   public function addCountry(CreateCountryRequest $request);
    public function updateCountry(int $id, Request $data);
    public function deleteCountry(int $id);
    public function getCountries(array $criteria);   


}