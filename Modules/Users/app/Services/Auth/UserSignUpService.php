<?php

namespace Modules\Users\Services\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Modules\Users\Http\Requests\SignUpRequest;
use Modules\Users\Repositories\Auth\UserRepository;
use Modules\Users\Repositories\Auth\UserSignUpRepository;
use Modules\Users\Services\Auth\IUserSignUpService as AuthIUserSignUpService;
use Modules\Users\Services\IUserSignUpService;
use Modules\Users\Services\IUserService;
use PhpParser\Node\Expr\Cast\Array_;

class UserSignUpService implements AuthIUserSignUpService 
{
    protected $userRepository;

    public function __construct(UserSignUpRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signUp(SignUpRequest $request)
    {
        $user = $this->userRepository->signUp($request);
        if($request->expectsJson())
        {
            $token = $user->createToken('my-app-token')->plainTextToken;
            return [
                'user' => $user,
                'token' => $token,
            ];

        }
        return $user;
        
    }
   
}
