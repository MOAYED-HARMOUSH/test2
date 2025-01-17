<?php

namespace Modules\Users\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Repositories\Auth\UserLoginRepository;
use Modules\Users\Repositories\Auth\UserRepository;
use Modules\Users\Repositories\Auth\UserSignUpRepository;
use Modules\Users\Services\Auth\IUserLoginService as AuthIUserLoginService;
use Modules\Users\Services\Interfaces\IUserLoginService ;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class UserLoginService implements AuthIUserLoginService

{
    protected $userRepository;

    public function __construct(UserLoginRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authenticateUser($request);

        if ($request->expectsJson()) {
            
            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
            return [
                'user' => $user,
                'token' => $token,
            ];
        } else {
            $this->handleWebLogin($user);
            return [];
        }
    }

    /**
     * Authenticate the user based on the request.
     *
     * @param LoginRequest $request
     * @return \App\Models\User
     * @throws \Exception
     */
    protected function authenticateUser(LoginRequest $request)
    {
        $loginInput = $request->input('emailOrPhone');
        $password = $request->input('password');

        $credentials = $this->getCredentials($loginInput, $password);

        if (!Auth::attempt($credentials, $request->has('remember'))) {
            throw new \Exception('Invalid credentials.');
        }

        return Auth::user();
    }

    protected function getCredentials($loginInput, $password)
    {
        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $loginInput, 'password' => $password];
        } else {
            return ['phone' => $loginInput, 'password' => $password];
        }
    }

    protected function handleWebLogin($user)
    {
        $refreshToken = Str::random(64);
        $expiresAt = now()->addDays(30);

        DB::table('refresh_tokens')->insert([
            'user_id' => $user->id,
            'refresh_token' => $refreshToken,
            'expires_at' => $expiresAt,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        cookie()->queue('refresh_token', $refreshToken, 60 * 24 * 30, '/', null, true, true);

        session()->put('expires_at', now()->addMinutes((int) config('session.lifetime')));
    }
    public function test()
    {
        return 'hi';
    }
   
}
