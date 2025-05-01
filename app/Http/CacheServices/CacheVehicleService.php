<?php

namespace App\Http\CacheServices;

class CacheVehicleService extends CacheService
{
    private $cache_key = 'vehicle_id_';

    public function __construct()
    {
        parent::__construct($this->cache_key);
    }

}
