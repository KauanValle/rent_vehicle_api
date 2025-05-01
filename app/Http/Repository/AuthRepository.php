<?php

namespace App\Http\Repository;

use App\Dto\AuthResponseDTO;
use App\Enums\AuthEnum;
use App\Http\CacheServices\CacheAuthService;
use App\Models\User;
use Exception;

class AuthRepository extends Repository
{
    protected User $model;
    protected CacheAuthService $cache;

    public function __construct(User $model, CacheAuthService $cache)
    {
        $this->model = $model;
        $this->cache = $cache;
        parent::__construct($model, $cache);
    }

    public function logout()
    {
        auth('api')->logout();
    }

    public function findAuthToken($credentials)
    {
        $userModel = $this->findByEmail($credentials['email']);
        $tokenExistsInCache = $this->cache->get($userModel->email);
        if ($tokenExistsInCache) {
            return $tokenExistsInCache;
        }

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $authDto =  $this->respondWithAuthModel($token);
        $this->cache->putWithTime($userModel->email, $authDto, 3600);
        return $authDto->toArray();
    }

    public function findByEmail($email): User
    {
        /** @var User|null $user */
        $user = $this->model->newQuery()->where('email', $email)->first();

        if (!$user) {
            throw new Exception(AuthEnum::USER_NOT_FOUND_MESSAGE, 404);
        }
        return $user;
    }

    protected function respondWithAuthModel($token): AuthResponseDTO
    {
        return new AuthResponseDTO($token);
    }

    protected function findOrFail(int $id)
    {
        $user = $this->model->find($id);

        if (!$user) {
            throw new Exception(AuthEnum::USER_NOT_FOUND_MESSAGE, 404);
        }

        return $user;
    }
}
