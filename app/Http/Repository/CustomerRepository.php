<?php

namespace App\Http\Repository;

use App\Enums\CustomerEnum;
use App\Http\CacheServices\CacheCustomerService;
use App\Models\Customer;
use Exception;

class CustomerRepository extends Repository
{
    protected $model;

    public function __construct(Customer $model, CacheCustomerService $cacheService)
    {
        $this->model = $model;
        parent::__construct($model, $cacheService);
    }

    protected function findOrFail(int $id): Customer
    {
        $customer = $this->model->find($id);

        if (!$customer) {
            throw new Exception(CustomerEnum::CUSTOMER_NOT_FOUND_MESSAGE, 404);
        }

        return $customer;
    }

}
