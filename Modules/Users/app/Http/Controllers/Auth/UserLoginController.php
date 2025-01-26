<?php

namespace Modules\Users\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Services\Auth\IUserLoginService as AuthIUserLoginService;
use Modules\Users\Services\Interfaces\IUserLoginService;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
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


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle the callback from Google
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        
        // Check if the user already exists in the database
        $user = User::where('email', $googleUser->getEmail())->first();
        
        // If the user doesn't exist, create a new one
        if (!$user) {
            $user = User::create([
                'firstName' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(999999), // or use a default password
            ]);
        }

        // Log the user in
        Auth::login($user, true);

        // Redirect to the dashboard or intended route
        $users = [];

        return view('users::dashboard.dashboard', compact('users'));
    }
}