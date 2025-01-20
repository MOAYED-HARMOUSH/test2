<?php
namespace Modules\Settings\Services\Country;

use Illuminate\Http\Request;
use Modules\Settings\Models\Country;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Http\Requests\CreateCountryRequest;
use Modules\Settings\Http\Requests\UpdateCountryRequest;

class CountryService implements ICountryService {
    public function addCountry(CreateCountryRequest $request) {
        return Country::create([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'dialing_code' => $request->input('dialing_code'),
        ]);
    }

    public function updateCountry(int $id, Request $data) {
        $country = Country::findOrFail($id);
        $country->update([
            'name' => [
                'en' => $data['name_en'],
                'ar' => $data['name_ar'],
            ],
            'dialing_code' => $data['dialing_code'],
        ]);
        return $country;
    }

    public function deleteCountry(int $id) {
        return Country::destroy($id);
    }

    public function getCountries(array $criteria) {
        return Country::when($criteria['search'] ?? null, function ($query, $search) {
            $query->where('name->en', 'like', "%$search%")
                ->orWhere('name->ar', 'like', "%$search%");
        })->get();
    }
}
