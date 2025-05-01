<?php

namespace App\Http\Controllers;

use App\Enums\VehicleEnum;
use App\Http\Requests\Vehicle\VehicleRequest;
use App\Http\Requests\Vehicle\VehicleUpdatedRequest;
use App\Http\Responses\VehicleResponses;
use App\Http\Services\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    private VehicleService $service;

    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $queryParams = $request->query();
        return $this->successResponse($this->service->getAll($queryParams), VehicleEnum::MESSAGE_RETRIEVED_ALL, 200);
    }

    public function show($id)
    {
        return $this->successResponse($this->service->getById($id), VehicleEnum::MESSAGE_RETRIEVED_ONE, 200);
    }

    public function store(VehicleRequest $request)
    {
        $customerValidated = $request->validated();
        $customer = $this->service->create($customerValidated);
        return $this->successResponse($customer, VehicleEnum::MESSAGE_CREATED, 201);
    }

    public function update(VehicleUpdatedRequest $request, $id)
    {
        $customerValidated = $request->validated();
        $customer = $this->service->update($id, $customerValidated);

        return $this->successResponse($customer, VehicleEnum::MESSAGE_UPDATED, 200);
    }

    public function destroy($id)
    {
        $customerDeleted = $this->service->delete($id);

        return $this->successResponse($customerDeleted, VehicleEnum::MESSAGE_DELETED, 200);
    }

    private function successResponse(mixed $data, string $message, int $statusCode = 200)
    {
        $response = new VehicleResponses($data, $message, $statusCode);
        return $response->serializeResponse();
    }
}
