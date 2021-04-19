<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

Trait AuthenticateItens {

    public function generatePassword($string)
    {
        return Hash::make($string, ['rounds' => 12]);
    }

    public function checkPassword($string, $hash)
    {
        return Hash::check($string, $hash);
    }

    public function generateToken($id, $aud)
    {
        $assign = env('JWT_ASSING', 'assinatura');

        $now = time();

        $payload = [
            'sub' => $id,
            'iat' => $now,
            'exp' => $now + 18000,
            'aud' => $aud,
        ];

        $jwt = JWT::encode($payload, $assign);

        return $jwt;
    }

    public function checkToken($token) 
    {
        
        JWT::decode($token, env('JWT_ASSING', 'assinatura',), ['HS256']);
    }

}