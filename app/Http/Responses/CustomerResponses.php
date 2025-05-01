<?php

namespace App\Http\Responses;

class CustomerResponses extends Response
{
    private $jsonResponse;
    public function __construct($data = null, $message = 'Operação concluída com sucesso.', $statusCode = 200)
    {
        $this->jsonResponse = parent::__construct($message, $data, $statusCode);
    }

    public function serializeResponse()
    {
        return $this->jsonResponse;
    }

}
