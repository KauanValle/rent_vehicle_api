<?php

namespace App\Http\Services;

use App\Enums\CustomerEnum;
use App\Http\Repository\CustomerRepository;
use App\Http\Services\ElasticSearch\CustomerElasticService;

class CustomerService extends Service
{
    public function __construct(CustomerRepository $repository, CustomerElasticService $customerElasticService)
    {
        parent::__construct($repository, $customerElasticService);
    }

    public function getById(int $id)
    {
        $deleted = parent::getById($id);
        if (!$deleted){
            throw new \Exception(CustomerEnum::CUSTOMER_NOT_FOUND_MESSAGE, 404);
        }
        return $deleted;
    }
}
