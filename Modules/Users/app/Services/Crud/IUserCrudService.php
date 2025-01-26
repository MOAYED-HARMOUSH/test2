<?php
namespace Modules\Users\Services\Crud;

use Illuminate\Database\Eloquent\Collection;
use Modules\Users\Http\Requests\createUserRequest;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Http\Requests\signUpRequest;

interface IUserCrudService{
    public function addUser(createUserRequest $user);    
    public function editUser(createUserRequest $user);    
    public function showUsers();    
    public function showUser();    
    public function deleteUser(createUserRequest $user);    


}