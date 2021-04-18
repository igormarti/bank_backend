<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class CreateDepositRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            "value.required" => "O Valor é um campo obrigatório.",
            "value.numeric" => "O Valor precisa ser númerico.",
            "value.min" => "O Valor mínimo para depósito é R$ 1,00.",
        ];
    }
}
