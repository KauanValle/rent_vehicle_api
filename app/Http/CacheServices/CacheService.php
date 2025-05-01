<?php

namespace App\Http\CacheServices;

use App\Dto\Dto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

abstract class CacheService
{
    private mixed $prefix;

    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    public function get(string $id)
    {
        return Cache::get($this->prefix . $id);
    }

    public function put(string $id, Model $entity): void
    {
        Cache::forever($this->prefix . $id, $entity->toArray());
    }

    public function putWithTime(string $id, Dto $entity, int $time): void
    {
        Cache::put($this->prefix . $id, $entity->toArray(), $time);
    }

    public function forget(string $id): void
    {
        Cache::forget($this->prefix . $id);
    }
}
