<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Users\Models\PasswordResetCode;
use Twilio\Rest\Client;

class PasswordResetCodeController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('users::auth.forget_password_choice');
    }
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('users::auth.reset_password');
    }
    
    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
    
        // Generate a random 6-digit code
        $code = random_int(100000, 999999);
    
        // Save the code in the database
        PasswordResetCode::updateOrInsert(
            ['email' => $request->email],
            [
                'code' => $code,
                'expires_at' => Carbon::now()->addMinutes(10), // Code valid for 10 minutes
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    
        // Send email
        Mail::raw("Your password reset code is: $code", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset Code');
        });
      //  $token = $request->route()->parameter('token');

        return view('users::auth.reset_password');
        return response()->json(['message' => 'Reset code sent to your email.']);
    }

    public function verifyCodeAndResetPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
        'code' => 'required|numeric',
        'password' => 'required|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Check if the code exists and is not expired
    $resetRecord = DB::table('password_reset_codes')
        ->where('email', $request->email)
        ->where('code', $request->code)
        ->where('expires_at', '>=', Carbon::now())
        ->first();

    if (!$resetRecord) {
        return response()->json(['error' => 'Invalid or expired code.'], 400);
    }

    // Update the user's password
    $user = User::where('email', $request->email)->first();
    $user->password = bcrypt($request->password);
    $user->save();

    // Delete the reset code after successful reset
    DB::table('password_reset_codes')->where('email', $request->email)->delete();

    return response()->json(['message' => 'Password reset successfully.']);
}

public function WsendCode(Request $request)
{
    $method = $request->input('reset_method');

     if ($method === 'whatsapp') {
        $request->validate(['phone' => 'required|numeric']);
        $phone = $request->phone;
        $code = random_int(100000, 999999);

        // Save code in the database
        User::where('phone', $phone)->update(['reset_code' => $code]);

        // Send WhatsApp message using Twilio
       $m= $this->sendWhatsAppMessage($phone, $code);
            return $m;
        return back()->with('success', 'Verification code sent to your WhatsApp.');
    }
    return $method;

    return back()->with('error', 'Invalid reset method.');
}

private function sendWhatsAppMessage($phone, $code)
{
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioNumber = env('TWILIO_WHATSAPP_FROM');
 
    $client = new Client($sid, $token);
    $client->messages->create(
        "whatsapp:$phone",
        [
            'from' => $twilioNumber,
            'body' => "Your password reset code is: $code"
        ]
    );
}
public function WresetPassword(Request $request)
{
    $request->validate([
        'email_or_phone' => 'required',
        'code' => 'required|numeric',
        'password' => 'required|confirmed|min:6'
    ]);

    $identifier = $request->email_or_phone;
    $code = $request->code;

    // Check if the code is correct
    $user = User::where('reset_code', $code)
                ->where(function ($query) use ($identifier) {
                    $query->where('email', $identifier)
                          ->orWhere('phone', $identifier);
                })
                ->first();

    if (!$user) {
        return back()->withErrors(['code' => 'Invalid code.']);
    }

    // Update the user's password
    $user->update(['password' => bcrypt($request->password), 'reset_code' => null]);

    return redirect()->route('auth.login.form')->with('success', 'Password has been reset.');
}

    
}
