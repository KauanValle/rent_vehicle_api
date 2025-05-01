<?php

namespace App\Http\Services\ElasticSearch;

class CustomerElasticService extends BaseElasticService
{
    protected function indexName(): string
    {
        return 'customer';
    }
}
