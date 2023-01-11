<?php
namespace App\Http\Controllers;

use App\Handlers\ApiResult;
use App\Helpers\TokenHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Register new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->input('email'))->first();
            if ($user) {
                throw new \Exception("User already exists.");
            }

            $user = User::create(request(['name', 'email', 'password']));
            $userTokenDetails = TokenHelper::createUserToken(
                $user,
                $request->header('Device-Name', 'unknown'),
            );

            return ApiResult::getSuccessResult($userTokenDetails, __('auth.token_created'));
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Returns newly generated token for passed credentials
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getToken(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->input('email'))->first();
            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                throw ValidationException::withMessages([
                    'email' => [__('validation.incorrect_credentials')],
                ]);
            }

            $userTokenDetails = TokenHelper::createUserToken(
                $user,
                $request->header('Device-Name', 'unknown'),
            );

            return ApiResult::getSuccessResult($userTokenDetails, __('auth.token_created'));
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Returns new token for currently authenticated user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(Request $request)
    {
        try {
            $userTokenDetails = TokenHelper::createUserToken(
                $request->user(),
                $request->header('Device-Name', 'unknown'),
            );

            $request->user()->currentAccessToken()->delete();

            return ApiResult::getSuccessResult($userTokenDetails, __('auth.token_refreshed'));
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), $e->getMessage());
        }
    }
}
