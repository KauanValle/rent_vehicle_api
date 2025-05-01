<?php

namespace App\Http\CacheServices;

class CacheCustomerService extends CacheService
{
    private $cache_key = 'customer_id_';

    public function __construct()
    {
        parent::__construct($this->cache_key);
    }
}
