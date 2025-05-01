<?php

namespace App\Http\Services\ElasticSearch;

class VehicleElasticService extends BaseElasticService
{
    protected function indexName(): string
    {
        return 'vehicle';
    }
}
