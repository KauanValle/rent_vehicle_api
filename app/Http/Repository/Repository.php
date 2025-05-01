<?php

namespace App\Http\Repository;

use App\Http\CacheServices\CacheService;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    private $model;
    private $cacheService;

    public function __construct(Model $model, CacheService $cache)
    {
        $this->model = $model;
        $this->cacheService = $cache;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        $entity = $this->getEntity($id);
        return $entity;
    }

    public function create(array $data)
    {
        $modelCreated = $this->model->create($data);
        $this->cacheService->put($modelCreated->id, $modelCreated);
        return $modelCreated;
    }

    public function update($id, array $data)
    {
        $entity = $this->getEntity($id);
        $entity->update($data);

        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->getEntity($id);
        $entity->delete();
        $this->cacheService->forget($id);

        return $entity;
    }

    protected function getEntity($id)
    {
        $entity = $this->cacheService->get($id);
        if(!$entity){
            $entity = $this->findOrFail($id);
            $this->cacheService->put($id, $entity);
        }

        return $entity;
    }

    abstract protected function findOrFail(int $id);
}
