<?php

namespace App\Http\Services;

use App\Http\Repository\Repository;
use App\Http\Services\ElasticSearch\BaseElasticService;
use Illuminate\Support\Facades\DB;

abstract class Service
{
    private BaseElasticService $baseElasticSearch;
    private Repository $repository;

    public function __construct(Repository $repository, BaseElasticService $baseElasticService)
    {
        $this->repository = $repository;
        $this->baseElasticSearch = $baseElasticService;
    }

    public function getAll($queryParams)
    {
        return $this->baseElasticSearch->findAll($queryParams);
    }

    public function getById(int $id)
    {
        return $this->baseElasticSearch->findById($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->repository->create($data);
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            return $this->repository->update($id, $data);
        });
    }

    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            return $this->repository->delete($id);
        });
    }
}
