<?php
namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;

class TokenHelper {

    /**
     * Creates a new user authentication token
     * @param $user
     * @param string $deviceName
     * @return array
     */
    static function createUserToken(User $user, string $deviceName = 'unknown'): array
    {
        $expiresAt = Carbon::now()->addMinutes(config('sanctum.expiration'));
        $token = $user->createToken(
            $deviceName,
            ['*'],
            $expiresAt,
        )->plainTextToken;

        return [
            'token' => $token,
            'token_expires_at' => $expiresAt,
        ];
    }
}
