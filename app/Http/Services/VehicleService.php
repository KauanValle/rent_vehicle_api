<?php

namespace App\Http\Services;

use App\Enums\VehicleEnum;
use App\Http\Repository\VehicleRepository;
use App\Http\Services\ElasticSearch\VehicleElasticService;

class VehicleService extends Service
{
    public function __construct(VehicleRepository $repository, VehicleElasticService $vehicleElasticService)
    {
        parent::__construct($repository, $vehicleElasticService);
    }

    public function getById(int $id)
    {
        $deleted = parent::getById($id);
        if (!$deleted){
            throw new \Exception(VehicleEnum::VEHICLE_NOT_FOUND_MESSAGE, 404);
        }
        return $deleted;
    }
}
