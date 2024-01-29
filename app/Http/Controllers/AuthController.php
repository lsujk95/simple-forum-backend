<?php
namespace App\Http\Controllers;

use App\Handlers\ApiResult;
use App\Helpers\TokenHelper;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    public function __construct(
        public UserRepositoryInterface $userRepository,
    ) { }

    /**
     * Register a new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        try {
            $user = $this->userRepository->getByEmail($request->input('email'));
            if ($user) {
                return ApiResult::getErrorResult('UNVALIDATED',[
                    'email' => [__('validation.user_already_exists')],
                ]);
            }

            $user = $this->userRepository->create($request->all());
            if ($user) {
                return ApiResult::getErrorResult('CREATE-ERROR.1');
            }

            $result = TokenHelper::createUserToken(
                $user,
                $request->header('Device-Name', 'unknown'),
            );

            $result['user'] = $user;
            $result['user_actions'] = $user->getActions();

            return ApiResult::getSuccessResult($result, __('auth.token_created'));
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
    public function getToken(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        try {
            $user = $this->userRepository->getByEmail($request->input('email'));
            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return ApiResult::getErrorResult('UNVALIDATED',[
                    'email' => [__('validation.incorrect_credentials')],
                ]);
            }

            $result = TokenHelper::createUserToken(
                $user,
                $request->header('Device-Name', 'unknown'),
            );

            $result['user'] = $user;
            $result['user_actions'] = $user->getActions();

            return ApiResult::getSuccessResult($result, __('auth.token_created'));
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
    public function refreshToken(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        $token = PersonalAccessToken::findToken($request->input('token'));
        if (empty($token)) {
            return ApiResult::getErrorResult('REFRESH-ERROR.2');
        }

        if ($token->expires_at > Carbon::now()) {
            return ApiResult::getErrorResult('REFRESH-ERROR.3');
        }

        try {
            $user = $this->userRepository->getById($token->tokenable_id);
            if (empty($user)) {
                return ApiResult::getErrorResult('REFRESH-ERROR.4');
            }

            $result = TokenHelper::createUserToken(
                $user,
                $request->header('Device-Name', 'unknown'),
            );
            $token->delete();

            $result['user'] = $user;
            $result['user_actions'] = $user->getActions();

            return ApiResult::getSuccessResult($result, __('auth.token_refreshed'));
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), $e->getMessage());
        }
    }
}
