<?php

namespace Modules\Users\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\createUserRequest;
use Modules\Users\Http\Requests\SignUpRequest;
use Modules\Users\Repositories\BaseRepository;

class UserSignUpRepository extends BaseRepository 
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function signUp(SignUpRequest $data)
    {
        try {
            Log::info($data);
            $user= User::create($data->validated());
            Log::info($user);
return $user;
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') { // رمز الخطأ لتكرار القيم الفريدة
                throw new \Exception('The Email has already been taken.');
            }
            throw new \Exception('An error occurred while creating the user.');
        }      
    }
    public function addNewUser(createUserRequest $data)
    {
        try {
            return User::create($data->validated());
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') { // رمز الخطأ لتكرار القيم الفريدة
                throw new \Exception('The email has already been taken.');
            }
            throw new \Exception('An error occurred while creating the user.');
        }  }
}
