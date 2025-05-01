<?php

namespace App\Http\Services;

use App\Builder\RentalBuilder;
use App\Http\Clients\ReportRevenue;
use App\Http\Repository\RentalRepository;
use App\Http\Services\ElasticSearch\RentalElasticService;
use App\Models\Rental;

class RentalService extends Service
{
    private $repository;
    private RentalBuilder $builder;

    public function __construct(RentalRepository $repository, RentalBuilder $builder, RentalElasticService $rentalElasticService)
    {
        $this->repository = $repository;
        $this->builder = $builder;
        parent::__construct($repository, $rentalElasticService);
    }

    public function create(array $data)
    {
        $rental = parent::create($data);
        $rental->load('customer', 'vehicle');
        return $rental;
    }

    public function start($id)
    {
        $rentalModel = $this->repository->findRentNotStarted($id);
        $rental = $this->builder
            ->withModel($rentalModel)
            ->setStartDate()
            ->build();

        $this->repository->start($rental, $id);

        return $rental;
    }

    public function end($id)
    {
        $rentalModel = $this->repository->findRentalNotFinished($id);
        $rental = $this->builder
            ->withModel($rentalModel)
            ->setEndDate()
            ->setTotalValue()
            ->build();

        $this->repository->end($rental, $id);
        return $rental;
    }

    public function getAll($queryParams)
    {
        $rentalsData = parent::getAll($queryParams);
        $rentals = collect($rentalsData)->map(function ($rentalsData) {
           $modelRental = new Rental((array) $rentalsData);
           $modelRental->load('customer', 'vehicle');
           return $modelRental;
        });

        return $rentals;
    }

    public function getReportsRevenue($start, $end)
    {
        return ReportRevenue::getInstance()
            ->createClient()
            ->fetchData(['start' => $start, 'end' => $end]);
    }

    public function getById(int $id)
    {
        $data = parent::getById($id);
        $rentalModel = new Rental($data);
        $rentalModel->load('customer', 'vehicle');

        return $rentalModel;
    }
}
