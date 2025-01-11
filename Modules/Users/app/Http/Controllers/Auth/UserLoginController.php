<?php

namespace Modules\Users\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Services\Auth\IUserLoginService as AuthIUserLoginService;
use Modules\Users\Services\Interfaces\IUserLoginService;

class UserLoginController extends Controller
{
    public AuthIUserLoginService $userService;

    public function __construct(AuthIUserLoginService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */

     public function showLoginForm()
     {
        return view('users::Auth.login');
    }

    public function login(LoginRequest $request) 
    {
        try{
        $user =$this->userService->login($request);
        if ($user) {

            if ($request->expectsJson()) {
                return $this->successResponse($user,200,'login succesfully');

            }

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