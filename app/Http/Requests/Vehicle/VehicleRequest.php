<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plate' => 'required|string|min:7|max:7|unique:vehicle,plate',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'daily_rate' => 'required|numeric|min:0.01'
        ];
    }


    public function messages(): array
    {
        return [
            'plate.required' => 'The plate field is required.',
            'plate.string' => 'The plate must be a string.',
            'plate.min' => 'The plate must be exactly 7 characters.',
            'plate.max' => 'The plate must be exactly 7 characters.',
            'plate.unique' => 'The plate has already been taken.',

            'make.required' => 'The make field is required.',
            'make.string' => 'The make must be a string.',
            'make.max' => 'The make may not be greater than 255 characters.',

            'model.required' => 'The model field is required.',
            'model.string' => 'The model must be a string.',
            'model.max' => 'The model may not be greater than 255 characters.',

            'daily_rate.required' => 'The daily rate field is required.',
            'daily_rate.numeric' => 'The daily rate must be a number.',
            'daily_rate.min' => 'The daily rate must be at least 0.01.',
        ];
    }
}
