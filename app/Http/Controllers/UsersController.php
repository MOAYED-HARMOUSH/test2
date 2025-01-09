<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Http\Requests\signUpRequest;
use Modules\Users\Services\Auth\UserService;

class UsersControlle extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function signUp(signUpRequest $request)
    {
        return 'hi';
        $user =$this->userService->signUp($request);
        if($user){
            return $this->successResponse($user,201,'created succesfully');
        }else{
            return $this->errorResponse([],400,'created failed');

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function test()
    {
        return 'hi';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
