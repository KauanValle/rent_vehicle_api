<?php

namespace App\Http\Controllers;

use App\Enums\RentalEnum;
use App\Http\Requests\Rental\RentalRequest;
use App\Http\Responses\RentalResponses;
use App\Http\Services\RentalService;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    protected $rentalService;

    public function __construct(RentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function create(RentalRequest $request)
    {
        $rentalValidated = $request->validated();
        $rental = $this->rentalService->create($rentalValidated);
        return $this->successResponse($rental, RentalEnum::MESSAGE_CREATED, 201);
    }

    public function start($id)
    {
        $rental = $this->rentalService->start($id);
        return $this->successResponse($rental, RentalEnum::MESSAGE_START, 200);
    }

    public function end($id)
    {
        $rental = $this->rentalService->end($id);
        return $this->successResponse($rental, RentalEnum::MESSAGE_END, 200);
    }

    public function index(Request $request)
    {
        $queryParams = $request->query();
        return $this->successResponse($this->rentalService->getAll($queryParams), RentalEnum::MESSAGE_RETRIEVED_REPORT_REVENUE, 200);
    }

    public function show($id)
    {
        return $this->successResponse($this->rentalService->getById($id), RentalEnum::MESSAGE_RETRIEVED_ONE, 200);
    }

    public function reportsRevenue(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        return $this->successResponse($this->rentalService->getReportsRevenue($start, $end), RentalEnum::MESSAGE_RETRIEVED_ALL, 200);
    }

    private function successResponse($data, $message, $statusCode = 200)
    {
        $response = new RentalResponses($data, $message, $statusCode);
        return $response->serializeResponse();
    }


}
