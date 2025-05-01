<?php

namespace App\Http\Repository;

use App\Enums\RentalEnum;
use App\Http\CacheServices\CacheRentalService;
use App\Models\Rental;
use Exception;

class RentalRepository extends Repository
{
    protected $model;
    private $cacheService;

    public function __construct(Rental $model, CacheRentalService $cache)
    {
        $this->model = $model;
        $this->cacheService = $cache;
        parent::__construct($model, $cache);
    }

    public function start($rental, $id)
    {
        return $this->saveAndForgetCache($rental, $id);
    }

    public function end($rental, $id)
    {
        return $this->saveAndForgetCache($rental, $id);
    }

    public function findRentalNotFinished($id)
    {
        $rental = $this->findById($id);
        if(!is_null($rental->end_date)){
            throw new Exception(RentalEnum::RENTAL_ALREADY_ENDED_MESSAGE, 401);
        }

        if(is_null($rental->start_date)){
            throw new Exception(RentalEnum::RENTAL_NOT_STARTING_MESSAGE, 401);
        }

        return $rental;
    }

    public function findRentNotStarted($id)
    {
        $rental = $this->findById($id);
        if(!is_null($rental->start_date)){
            throw new Exception(RentalEnum::RENTAL_ALREADY_STARTED_MESSAGE, 401);
        }

        return $rental;
    }

    protected function findOrFail(int $id)
    {
        $rental = $this->model->find($id);

        if (!$rental) {
            throw new Exception(RentalEnum::RENTAL_NOT_FOUND_MESSAGE, 404);
        }

        return $rental;
    }

    private function saveAndForgetCache($rental, $id)
    {
        $rental->save();
        $this->cacheService->forget($id);
        return $rental;
    }
}
