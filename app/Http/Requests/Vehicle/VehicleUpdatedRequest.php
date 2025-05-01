<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class VehicleUpdatedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plate' => 'nullable|string|min:7|max:7|unique:vehicle,plate',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'daily_rate' => 'nullable|numeric|min:0.01'
        ];
    }

    public function messages(): array
    {
        return [
            'plate.string' => 'The plate must be a string.',
            'plate.min' => 'The plate must be exactly 7 characters.',
            'plate.max' => 'The plate must be exactly 7 characters.',
            'plate.unique' => 'The plate has already been taken.',

            'make.string' => 'The make must be a string.',
            'make.max' => 'The make may not be greater than 255 characters.',

            'model.string' => 'The model must be a string.',
            'model.max' => 'The model may not be greater than 255 characters.',

            'daily_rate.numeric' => 'The daily rate must be a number.',
            'daily_rate.min' => 'The daily rate must be at least 0.01.',
        ];
    }
}
