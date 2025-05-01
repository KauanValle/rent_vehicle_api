<?php

namespace App\Http\CacheServices;

class CacheAuthService extends CacheService
{
    private $cache_key = 'auth_id_';

    public function __construct()
    {
        parent::__construct($this->cache_key);
    }
}
