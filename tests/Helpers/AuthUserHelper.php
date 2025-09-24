<?php

namespace Tests\Helpers;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthUserHelper
{
    /**
     * Crea un usuario y devuelve un token JWT válido
    */

    public static function createUserAndGetToken()
    {
        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user);

        return $token;
    }
}
