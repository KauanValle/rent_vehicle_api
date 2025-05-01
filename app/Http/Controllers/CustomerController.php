<?php

namespace App\Http\Controllers;

use App\Enums\CustomerEnum;
use App\Http\Requests\Customer\CustomerRequest;
use App\Http\Requests\Customer\CustomerUpdatedRequest;
use App\Http\Responses\CustomerResponses;
use App\Http\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerService $service;

    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $queryParams = $request->query();
        return $this->successResponse($this->service->getAll($queryParams), CustomerEnum::MESSAGE_RETRIEVED_ALL, 200);
    }

    public function show($id)
    {
        return $this->successResponse($this->service->getById($id), CustomerEnum::MESSAGE_RETRIEVED_ONE, 200);
    }

    // ok
    public function store(CustomerRequest $request)
    {
        $customerValidated = $request->validated();
        $customer = $this->service->create($customerValidated);

        return $this->successResponse($customer, CustomerEnum::MESSAGE_CREATED, 201);
    }

    public function update(CustomerUpdatedRequest $request, $id)
    {
        $customerValidated = $request->validated();
        $customer = $this->service->update($id, $customerValidated);

        return $this->successResponse($customer, CustomerEnum::MESSAGE_UPDATED, 200);
    }

    public function destroy($id)
    {
        $customerDeleted = $this->service->delete($id);
        return $this->successResponse($customerDeleted, CustomerEnum::MESSAGE_DELETED, 200);
    }

    private function successResponse(mixed $data, string $message, int $statusCode = 200)
    {
        $response = new CustomerResponses($data, $message, $statusCode);
        return $response->serializeResponse();
    }

}
