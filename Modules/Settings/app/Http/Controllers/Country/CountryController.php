<?php
namespace Modules\Settings\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request as ClientRequest;
use Modules\Settings\Services\Country\ICountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Modules\Settings\Http\Requests\CreateCountryRequest;
use Modules\Settings\Http\Requests\UpdateCountryRequest;
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

    public function store(CreateCountryRequest $request) {
   
        $country = $this->countryService->addCountry($request);
        return $request->expectsJson() 
            ? $this->successResponse($country) 
            : redirect()->route('settings.countries.index')->with('success', __('Country added successfully'));
    }

    public function update(Request $request, $id) { //toDO MAKE IT UPDATE REQUEST  
        $country = $this->countryService->updateCountry($id,$request);
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
