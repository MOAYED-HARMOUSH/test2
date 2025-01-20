<?php

namespace Modules\Users\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Modules\Settings\Services\Country\CountryService;
use Modules\Users\Http\Requests\createUserRequest;
use Modules\Users\Http\Requests\signUpRequest;
use Modules\Users\Services\Auth\IUserSignUpService as AuthIUserSignUpService;
use Modules\Users\Services\Auth\UserService;
use Modules\Users\Services\IUserSignUpService;

class UserSignUpController extends Controller
{
    public AuthIUserSignUpService $userService;
    protected CountryService $countryService;

    public function __construct(AuthIUserSignUpService $userService,CountryService $countryService)
    {
        $this->userService = $userService;
        $this->countryService = $countryService;

    }
    /**
     * Display a listing of the resource.
     */

     public function showSignupForm(Request $request)
     {
        $countries = $this->countryService->getCountries($request->all());
        if ($request->expectsJson()) {
            return $this->successResponse($countries);
        }
        return view('users::Auth.signup', compact('countries'));
    }
    public function addUser(createUserRequest $request)
    {
        try {
            $user = $this->userService->addUser($request);

            if ($user) {
                // رسالة النجاح
          session()->flash('success', 'User added successfully.');

          $users = $this->userService->showUers();
          return redirect()->intended('auth/AllUsers');
   
    }

        } catch (\Exception $e) {
            // رسالة الخطأ
           
            session()->flash('error', 'an error here');
            return redirect()->route('users::auth.AllUsers',compact('users'));
        }
    }
    
  
    public function signUp(signUpRequest $request)
    {
        try {
        $user =$this->userService->signUp($request);
        if ($user) {

            if ($request->expectsJson()) {
                return $this->successResponse($user,201,'created succesfully');

            }

            $request->session()->put('user', $user);
            session()->flash('success', 'Registration successful! Welcome to the site.');

            return redirect()->intended('auth/dashboard');
        }
    }

catch (\Exception $e) {
    $errorMessage = $e->getMessage();

    if ($request->expectsJson()) {
        return $this->errorResponse([], 400, $errorMessage);
    }

    session()->flash('error', $errorMessage);
    return redirect()->back()->withInput();
}
     
}
}