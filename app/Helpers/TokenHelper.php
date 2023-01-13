<?php
namespace App\Helpers;

use Carbon\Carbon;

class TokenHelper {

    /** Creates a new user authentication token
     * @param $user
     * @param string $deviceName
     * @return array
     */
    static function createUserToken($user, string $deviceName = 'unknown')
    {
        $expiresAt = Carbon::now()->addMinutes(config('sanctum.expiration'));
        $token = $user->createToken(
            $deviceName,
            ['*'],
            $expiresAt,
        )->plainTextToken;

        return [
            'token' => $token,
            'expires_at' => $expiresAt,
            'user' => $user,
        ];
    }
}
