<?php

namespace Modules\Users\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Services\Auth\IUserLoginService as AuthIUserLoginService;
use Modules\Users\Services\Interfaces\IUserLoginService;
use Illuminate\Support\Str;
use Modules\Users\Http\Controllers\Crud\UserCrudController;
use Modules\Users\Services\Auth\UserSignUpService;

class UserLoginController extends Controller
{
    public AuthIUserLoginService $userService;
    public UserSignUpService $userSignUp;


    public function __construct(AuthIUserLoginService $userService,UserSignUpService $userSignUp)
    {
        $this->userService = $userService;
        $this->userSignUp = $userSignUp;

    }
  
     public function showLoginForm()
     {
        return view('users::auth.login'); //toDo  return redirect ...
    }

    public function login(LoginRequest $request)
    {
        try {
            $response = $this->userService->login($request);

            if ($request->expectsJson()) {
                return $this->successResponse($response, 200, 'Login successful');
            } else {
                session()->flash('success', 'Login successful! Welcome to the site.');
                return redirect()->intended('auth/dashboard');
            }
        } catch (\Exception $e) {
            return $this->handleLoginError($request, $e);
        }
    }

    protected function handleLoginError($request, $e)
    {
        $errorMessage = $e->getMessage();

        if ($request->expectsJson()) {
            return $this->errorResponse([], 400, $errorMessage);
        } else {
            session()->flash('error', $errorMessage);
            return redirect()->back()->with(['error' => 'An issue occurred during login.']);
        }
    }
}