<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\ApiResult;

class UserController extends Controller
{
    /**
     * Returns user details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return ApiResult::getSuccessResult($request->user());
    }

    /**
     * Returns user actions
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function actions(Request $request)
    {
        return ApiResult::getSuccessResult($request->user()->getActions());
    }

    /**
     * Returns user roles
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function roles(Request $request)
    {
        return ApiResult::getSuccessResult($request->user()->getRoles());
    }
}
