<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class AuthJwt
{
    public static function encryptAuth($data)
    {
        $data['exp'] = time() + 86400; // 1 day
        try {
            return JWT::encode($data, env('HASH_KEY'));
        } catch (\Exception $exception) {
            return false;
        }
    }

    public static function decryptAuth($token)
    {
        try {
            return JWT::decode($token, env('HASH_KEY'), array(env('ALGORITHM')));
        } catch (\Exception $exception) {
            return false;
        }
    }

    public static function refreshToken($data)
    {
        $data['last_login'] = time();
        try {
            return JWT::encode($data, env('HASH_KEY'));
        } catch (\Exception $exception) {
            return false;
        }
    }
}
