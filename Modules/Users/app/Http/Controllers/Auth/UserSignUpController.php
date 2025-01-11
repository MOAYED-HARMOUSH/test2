<?php

namespace Modules\Users\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Http\Requests\signUpRequest;
use Modules\Users\Services\Auth\IUserSignUpService as AuthIUserSignUpService;
use Modules\Users\Services\Auth\UserService;
use Modules\Users\Services\IUserSignUpService;

class UserSignUpController extends Controller
{
    public AuthIUserSignUpService $userService;

    public function __construct(AuthIUserSignUpService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */

     public function showSignupForm()
     {
        return view('users::Auth.signup');
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

            return view('users::layouts.master'); //toDo  return redirect ...
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