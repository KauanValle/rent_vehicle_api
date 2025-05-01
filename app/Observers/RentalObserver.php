<?php

namespace App\Observers;

use App\Jobs\Rental\DeleteRentalElasticJob;
use App\Jobs\Rental\IndexRentalElasticJob;
use App\Models\Rental;

class RentalObserver
{
    public function created(Rental $rental): void
    {
        IndexRentalElasticJob::dispatch($rental);
    }

    public function updated(Rental $rental): void
    {
        IndexRentalElasticJob::dispatch($rental);
    }

    public function deleted(Rental $rental): void
    {
        DeleteRentalElasticJob::dispatch($rental);
    }
}
