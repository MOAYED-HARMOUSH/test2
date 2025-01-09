<?php

namespace App\Http\Controllers;

use App\Response\AppResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;

 class Controller
{
    use AuthorizesRequests,ValidatesRequests;

    public function test()
    {
        return 'hi';
    }

    protected function successResponse($data ,$statusCode=200 ,$errorMessage=''):JsonResponse
    {
        return response()->json(new AppResponse($data,$statusCode,$errorMessage));
    }
    protected function errorResponse($data ,$statusCode=400 ,$errorMessage='error'):JsonResponse
    {
        return response()->json(new AppResponse($data,$statusCode,$errorMessage));
    }
    //
}
