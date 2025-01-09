<?php
namespace Modules\Users\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Users\Http\Requests\signUpRequest;

interface IUserService{
    public function signUp(signUpRequest $user):?Array;
    public function test();

}