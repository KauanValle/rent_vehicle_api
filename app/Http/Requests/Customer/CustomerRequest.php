<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customer,email',
            'phone' => 'required|string|max:15',
            'cnh' => 'required|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'O Email deve ser válido.',
            'email.unique' => 'Este Email já está em uso.',
            'phone.required' => 'O campo Telefone é obrigatório.',
            'cnh.required' => 'O campo CNH é obrigatório.',
            'cnh.string' => 'A CNH deve ser um texto válido.',
            'cnh.max' => 'A CNH deve ter no máximo 20 caracteres.',

        ];
    }
}
