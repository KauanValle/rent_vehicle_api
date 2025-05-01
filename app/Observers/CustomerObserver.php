<?php

namespace App\Observers;

use App\Jobs\Customer\DeleteCustomerElasticJob;
use App\Jobs\Customer\IndexCustomerElasticJob;
use App\Models\Customer;

class CustomerObserver
{
    public function created(Customer $customer): void
    {
        IndexCustomerElasticJob::dispatch($customer);
    }

    public function updated(Customer $customer): void
    {
        IndexCustomerElasticJob::dispatch($customer);
    }

    public function deleted(Customer $customer): void
    {
        DeleteCustomerElasticJob::dispatch($customer);
    }
}
