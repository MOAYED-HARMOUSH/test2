<?php

namespace Modules\Users\Services\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Modules\Users\Http\Requests\signUpRequest;
use Modules\Users\Repositories\Auth\UserRepository;
use Modules\Users\Services\IUserService;
use PhpParser\Node\Expr\Cast\Array_;

class UserService implements IUserService 
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signUp(signUpRequest $user): ?Array
    {
        $user = $this->userRepository->signUp($user);
        $token = $user->createToken('my-app-token')->plainTextToken;
    
        return [
            'user' => $user,
            'token' => $token,
        ];
    }
    public function test()
    {
        return 'hi';
    }
   
}
