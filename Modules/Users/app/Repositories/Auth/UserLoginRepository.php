<?php

namespace Modules\Users\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Http\Requests\SignUpRequest;
use Modules\Users\Repositories\BaseRepository;

class UserLoginRepository extends BaseRepository 
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login(LoginRequest $data)
    {
        return User::where('email',$data['email'])->first();
    }
}
