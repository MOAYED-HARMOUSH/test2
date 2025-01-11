<?php

namespace Modules\Users\Services\Auth;

use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Repositories\Auth\UserLoginRepository;
use Modules\Users\Repositories\Auth\UserRepository;
use Modules\Users\Repositories\Auth\UserSignUpRepository;
use Modules\Users\Services\Auth\IUserLoginService as AuthIUserLoginService;
use Modules\Users\Services\Interfaces\IUserLoginService ;

class UserLoginService implements AuthIUserLoginService

{
    protected $userRepository;

    public function __construct(UserLoginRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
            $user = $this->userRepository->login($request);
            if ($user && Hash::check($request->password, $user->password)) {

                if($request->expectsJson())
                {
                    $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
                return [
                    'user' => $user,
                    'token' => $token,
                ];
            }
            return $user;

            }
           
    }
    public function test()
    {
        return 'hi';
    }
   
}
