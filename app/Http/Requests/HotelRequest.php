<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'website' => '',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo Nome obrigatório.',
            'name.string' => 'O Nome é inválido.',

            'address.required' => 'Campo Endereço obrigatório.',
            'address.string' => 'O Endereço é inválido.',

            'city.required' => 'Campo Cidade obrigatório.',
            'city.string' => 'O Cidade é inválido.',

            'state.required' => 'Campo Estado obrigatório.',
            'state.string' => 'O Estado é inválido.',

            'zip_code.required' => 'Campo CEP obrigatório.',
            'zip_code.string' => 'O CEP é inválido.',
        ];
    }
}
