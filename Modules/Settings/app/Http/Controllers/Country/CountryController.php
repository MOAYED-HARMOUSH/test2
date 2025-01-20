<?php
namespace Modules\Settings\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Modules\Settings\Services\Country\ICountryService;
use Illuminate\Http\Request;
use Modules\Settings\Services\Country\CountryService;

class CountryController extends Controller {
    protected ICountryService $countryService;

    public function __construct(CountryService $countryService) {
        $this->countryService = $countryService;
    }

    public function index(Request $request) {
        $countries = $this->countryService->getCountries($request->all());
        if ($request->expectsJson()) {
            return $this->successResponse($countries);
        }
        return view('settings::countries.country', compact('countries'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'dialing_code' => 'required|regex:/^\+\d{1,5}$/|unique:countries',
        ]);

        $country = $this->countryService->addCountry($request);
        return $request->expectsJson() 
            ? $this->successResponse($country) 
            : redirect()->route('settings.countries.index')->with('success', __('Country added successfully'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'dialing_code' => 'required|regex:/^\+\d{1,5}$/|unique:countries,dialing_code,' . $id,
        ]);

        $country = $this->countryService->updateCountry($id, $validated);
        return $request->expectsJson() 
            ? $this->successResponse($country) 
            : redirect()->route('settings.countries.index')->with('success', __('Country updated successfully'));
    }

    public function destroy(Request $request, $id) {
        $this->countryService->deleteCountry($id);
        return $request->expectsJson() 
            ? $this->successResponse(null, 204) 
            : redirect()->route('settings.countries.index')->with('success', __('Country deleted successfully'));
    }
}
