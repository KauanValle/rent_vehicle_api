<?php

namespace App\Http\Responses;

abstract class Response
{
    public function __construct($message, $data, $statusCode)
    {
        return [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ];
    }

    abstract function serializeResponse();
}
