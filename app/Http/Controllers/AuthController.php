<?php

namespace App\Http\Controllers;

use App\Enums\AuthEnum;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Responses\AuthResponses;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function register(AuthRequest $request)
    {
        $validatedData = $request->validated();
        $created = $this->service->create($validatedData);
        return $this->successResponse($created, AuthEnum::MESSAGE_CREATED, 201);
    }

    public function login(Request $request)
    {
        return $this->successResponse($this->service->login($request), AuthEnum::MESSAGE_LOGIN, 200);
    }

    public function logout()
    {
        $this->service->logout();

        return $this->successResponse([], AuthEnum::MESSAGE_LOGOUT, 200);
    }

    protected function successResponse($data, $message, $statusCode){
        $response = new AuthResponses($data, $message, $statusCode);
        return $response->serializeResponse();
    }
}
