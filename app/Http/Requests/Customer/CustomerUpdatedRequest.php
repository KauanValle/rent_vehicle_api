<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdatedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:customer,email,' . $this->route('id'),
            'phone' => 'nullable|string|max:15',
            'cnh' => 'nullable|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'string' => 'The name must be a valid string.',
                'max' => 'The name may not be greater than 255 characters.',]
            ,
            'email' => [
                'email' => 'The email must be a valid email address.',
                'unique' => 'This email is already in use.',
            ],
            'phone' => [
                'string' => 'The phone must be a valid string.',
                'max' => 'The phone may not be greater than 15 characters.',
            ],
            'cnh' => [
                'string' => 'The CNH must be a valid string.',
                'max' => 'The CNH may not be greater than 20 characters.',
            ],
        ];
    }
}
