<?php

namespace App\Http\Repository;

use App\Enums\VehicleEnum;
use App\Http\CacheServices\CacheVehicleService;
use App\Models\Vehicle;
use Exception;

class VehicleRepository extends Repository
{
    protected $model;

    public function __construct(Vehicle $model, CacheVehicleService $cache)
    {
        $this->model = $model;
        parent::__construct($model, $cache);
    }

    protected function findOrFail(int $id)
    {
        $vehicle = $this->model->find($id);

        if (!$vehicle) {
            throw new Exception(VehicleEnum::VEHICLE_NOT_FOUND_MESSAGE, 404);
        }

        return $vehicle;
    }
}
