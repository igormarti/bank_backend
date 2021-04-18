<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            "value" => "required|numeric|min:5"
        ];
    }

    public function messages()
    {
        return [
            "value.required" => "O Valor é um campo obrigatório.",
            "value.numeric" => "O Valor precisa ser númerico.",
            "value.min" => "O valor minímo para sacar é R$ 5,00.",
        ];
    }
}
