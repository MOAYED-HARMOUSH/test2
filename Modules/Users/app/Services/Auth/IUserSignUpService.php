<?php
namespace Modules\Users\Services\Auth;

use Illuminate\Database\Eloquent\Collection;
use Modules\Users\Http\Requests\createUserRequest;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Http\Requests\signUpRequest;

interface IUserSignUpService{
    public function signUp(signUpRequest $user);    
    public function addUser(createUserRequest $user);    
    public function showUers();    


}