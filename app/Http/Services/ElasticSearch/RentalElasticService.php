<?php

namespace App\Http\Services\ElasticSearch;

class RentalElasticService extends BaseElasticService
{

    protected function indexName(): string
    {
        return 'rental';
    }
}
