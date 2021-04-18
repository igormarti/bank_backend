<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

abstract class FormRequest extends LaravelFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $this->formatErrors((new ValidationException($validator))->errors());

        throw new HttpResponseException(
            response()->json(['status'=>false,'errors' => $errors], JsonResponse::HTTP_BAD_REQUEST)
        );
    }


    private function formatErrors($errors){
        $errors_formated = [];
        foreach ($errors as $k => $e){
            array_push($errors_formated,end($e));
        }
        return $errors_formated;
    }
}
