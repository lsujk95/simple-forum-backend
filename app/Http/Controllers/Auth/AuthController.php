<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Controller;
use App\Handlers\ApiResult;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
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

            $expiresAt = Carbon::now()->addMinutes(config('sanctum.expiration'));
            $userToken = $user->createToken(
                $request->input('device_name'),
                ['*'],
                $expiresAt,
            )->plainTextToken;

            return ApiResult::getSuccessResult([
                'token' => $userToken,
                'expires_at' => $expiresAt,
            ]);
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

            $expiresAt = Carbon::now()->addMinutes(config('sanctum.expiration'));
            $newToken = $request->user()->createToken(
                $request->input('device_name'),
                ['*'],
                $expiresAt,
            )->plainTextToken;

            $request->user()->currentAccessToken()->delete();

            return ApiResult::getSuccessResult([
                'token' => $newToken,
                'expires_at' => $expiresAt,
            ]);
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), $e->getMessage());
        }
    }
}
