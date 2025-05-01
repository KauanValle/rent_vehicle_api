<?php

namespace App\Http\CacheServices;

class CacheRentalService extends CacheService
{
    private $cache_key = 'rental_id_';

    public function __construct()
    {
        parent::__construct($this->cache_key);
    }

}
