<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotel_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo Nome obrigatório.',
            'name.string' => 'O Nome é inválido.',

            'description.required' => 'Campo Endereço obrigatório.',
            'description.string' => 'O Endereço é inválido.',

            'hotel_id.required' => 'Campo Hotel obrigatório.',
            'hotel_id.string' => 'O Hotel é inválido.',
        ];
    }
}
