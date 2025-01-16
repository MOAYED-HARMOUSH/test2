<?php

namespace Modules\Users\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Modules\Users\Http\Requests\createUserRequest;
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
    public function addUser(createUserRequest $request)
    {
        try {
            $user = $this->userService->addUser($request);

            if ($user) {
                // رسالة النجاح
          session()->flash('success', 'User added successfully.');
          return view('users::dashboard.dashboard'); // اسم ملف العرض
          //     return redirect()->route('users::dashboard.dashboard');
        }

        } catch (\Exception $e) {
            // رسالة الخطأ
           
            session()->flash('error', 'an error here');
          return view('users::dashboard.dashboard'); // اسم ملف العرض
        }
    }
    
    //

    public function dashboard()
    {
        return view('users::dashboard.dashboard'); // اسم ملف العرض

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



public function showForgetPasswordChoice()
    {
        return view('users::auth.forget_password_choice');
    }

    public function handleForgetPasswordChoice(Request $request)
    {
        // $request->validate([
        //     'reset_method' => 'required|in:email,mobile',
        //     'email' => 'email|exists:users,email',
        //     'mobile' => 'string|exists:users,mobile',
        // ]);

        // $user = $request->input('reset_method') === 'email'
        //     ? User::where('email', $request->email)->first()
        //     : User::where('mobile', $request->mobile)->first();

        // // Generate and store reset token
        // $token = Password::createToken($user);

        // // Send reset code via email or mobile
        // if ($request->reset_method === 'email') {
        //     Mail::send('emails.reset_password', ['token' => $token], function($message) use ($user) {
        //         $message->to($user->email);
        //     });
        // } else {
        //     // Send SMS with reset code to $user->mobile
        // }

       // return redirect()->route('users::auth.password.reset.form', ['token' => $token]);

       // return redirect()->route('users::auth.reset_password');
        return view('users::auth.reset_password'); // اسم ملف العرض

    }

    public function showResetPasswordForm($token)
    {
       // return view('users::auth.reset_password', ['token' => $token]);
        return view('users::auth.reset_password');

    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Verify reset token and update password
        $user = User::where('reset_token', $request->verification_code)->first();

        if ($user && ! $user->reset_token_expired) {
            $user->password = bcrypt($request->password);
            $user->reset_token = null;
            $user->reset_token_expiry = null;
            $user->save();

            return redirect()->route('login')->with('success', 'Password reset successful.');
        }

        return back()->withErrors(['verification_code' => 'Invalid or expired code.']);
    }

}