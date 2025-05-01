<?php

namespace App\Observers;

use App\Jobs\Vehicle\DeleteVehicleElasticJob;
use App\Jobs\Vehicle\IndexVehicleElasticJob;
use App\Models\Vehicle;

class VehicleObserver
{
    public function created(Vehicle $vehicle): void
    {
        IndexVehicleElasticJob::dispatch($vehicle);
    }

    public function updated(Vehicle $vehicle): void
    {
        IndexVehicleElasticJob::dispatch($vehicle);
    }

    public function deleted(Vehicle $vehicle): void
    {
        DeleteVehicleElasticJob::dispatch($vehicle);
    }
}
