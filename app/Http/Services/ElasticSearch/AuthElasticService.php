<?php

namespace App\Http\Services\ElasticSearch;

class AuthElasticService extends BaseElasticService
{
    protected function indexName(): string
    {
        return 'auth';
    }

}
