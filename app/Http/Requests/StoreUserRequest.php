<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => "required",
            'email' => "required|unique:users,email|email",
            'password' => "required|min:6",
        ];
    }

    public function messages()
    {
        return [
          "name.required" => "O Nome é um campo obrigatório",
          "email.required" => "O Email é um campo obrigatório",
          "email.unique" => "Esse Email já está em uso.",
          "email.email" => "Valor digitado não é um email válido.",
          "password.required" => "A Senha é um campo obrigatório.",
          "password.min" => "A Senha deve ter no mínimo 6 caracteres.",
        ];
    }
}
