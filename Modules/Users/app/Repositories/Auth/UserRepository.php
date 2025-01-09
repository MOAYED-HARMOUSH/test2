<?php

namespace Modules\Users\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\signUpRequest;
use Modules\Users\Repositories\BaseRepository;

class UserRepository extends BaseRepository 
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    
    public function signUp(signUpRequest $data)
    {
        return User::create($data->validated());
      
    }
}
