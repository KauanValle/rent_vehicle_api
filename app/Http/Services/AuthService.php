<?php

namespace App\Http\Services;

use App\Http\Repository\AuthRepository;
use App\Http\Services\ElasticSearch\AuthElasticService;
use Illuminate\Http\Request;

class AuthService extends Service
{
    protected $repository;
    public function __construct(AuthRepository $repository, AuthElasticService $authElasticService)
    {
        $this->repository = $repository;
        parent::__construct($repository, $authElasticService);
    }

    public function logout()
    {
        $this->repository->logout();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        return $this->repository->findAuthToken($credentials);
    }
}
