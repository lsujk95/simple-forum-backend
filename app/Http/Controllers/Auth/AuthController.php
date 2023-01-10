<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Controller;
use App\Handlers\ApiResult;
use App\Models\User;
use App\Helpers\TokenHelper;

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
                'device_name' => 'required',
            ]);

            $user = User::where('email', $request->input('email'))->first();
            if ($user) {
                throw new \Exception("User already exists.");
            }

            $user = User::create(request(['name', 'email', 'password']));
            $userTokenDetails = TokenHelper::createUserToken(
                $user,
                $request->input('device_name'),
            );

            return ApiResult::getSuccessResult($userTokenDetails);
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
                'device_name' => 'required',
            ]);

            $user = User::where('email', $request->input('email'))->first();
            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $userTokenDetails = TokenHelper::createUserToken(
                $user,
                $request->input('device_name'),
            );

            return ApiResult::getSuccessResult($userTokenDetails);
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
            $request->validate([
                'device_name' => 'required',
            ]);

            $userTokenDetails = TokenHelper::createUserToken(
                $request->user(),
                $request->input('device_name'),
            );

            $request->user()->currentAccessToken()->delete();

            return ApiResult::getSuccessResult($userTokenDetails);
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), $e->getMessage());
        }
    }
}
