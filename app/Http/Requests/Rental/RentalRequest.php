<?php

namespace App\Http\Requests\Rental;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vehicle_id' => ['required', 'integer'],
            'customer_id' => ['required', 'integer'],
        ];
    }


    public function messages(): array
    {
        return [
            'vehicle_id.required' => 'The vehicle ID is required.',
            'vehicle_id.integer' => 'The vehicle ID must be an integer.',
            'customer_id.required' => 'The customer ID is required.',
            'customer_id.integer' => 'The customer ID must be an integer.',
        ];
    }
}
