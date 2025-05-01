<?php

namespace App\Dto;

class AuthResponseDTO extends Dto
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    function toArray()
    {
        return [
            'access_token' => $this->token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }
}
