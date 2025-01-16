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
    /**
     * Display a listing of the resource.
     */

     public function showLoginForm()
     {
        return view('users::auth.login'); //toDo  return redirect ...
    }

    public function login(LoginRequest $request) 
    {
        //return view('users::auth.login'); //toDo  return redirect ...
        
        //
        {
            $loginInput = $request->input('emailOrPhone');
            $password = $request->input('password');
            $remember = $request->has('remember');
            
            $credentials = [];
            
            if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
                $credentials = ['email' => $loginInput, 'password' => $password];
            } else {
                $credentials = ['phone' => $loginInput, 'password' => $password];
            }
    
            if (Auth::attempt($credentials, $remember )) {
                // Generate Refresh Token
                $refreshToken = Str::random(64);
                $expiresAt = now()->addDays(30); // Ensure '30' is an integer
    
                // Store the Refresh Token in the Database
                DB::table('refresh_tokens')->insert([
                    'user_id' => Auth::id(),
                    'refresh_token' => $refreshToken,
                    'expires_at' => $expiresAt,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                // Store the Refresh Token in a Secure HTTP-Only Cookie
                cookie()->queue('refresh_token', $refreshToken, 60 * 24 * 30, '/', null, true, true);
    
                // Set Session Expiry based on 'session.lifetime' setting
                session()->put('expires_at', now()->addMinutes((int) config('session.lifetime')));


                $users = $this->userSignUp->showUers();
             //  session()->put('users', $users);

               return redirect()->intended('auth/dashboard');
            }
            session()->flash('error', 'error');

            return redirect()->back()->with(['error' => 'An Issue is incorrect.']);
        }

        //
        try{
        $user =$this->userService->login($request);
        if ($user) {

            if ($request->expectsJson()) {
                return $this->successResponse($user,200,'login succesfully');

            }

            //

            
            //
            $request->session()->put('user', $user);
            session()->flash('success', 'login successful! Welcome to the site.');

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