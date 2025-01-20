<?php
namespace Modules\Settings\Services\Country;

use Illuminate\Database\Eloquent\Collection;
use Modules\Settings\Http\Requests\CreateCountryRequest;


interface ICountryService{
   public function addCountry(CreateCountryRequest $request);
    public function updateCountry(int $id, array $data);
    public function deleteCountry(int $id);
    public function getCountries(array $criteria);   


}