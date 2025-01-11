<?php
namespace Modules\Users\Services\Auth;

 use Modules\Users\Http\Requests\LoginRequest;
 
interface IUserLoginService{
    public function login(LoginRequest $user);


}