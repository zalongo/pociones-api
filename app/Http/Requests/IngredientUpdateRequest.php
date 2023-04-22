<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class IngredientUpdateRequest extends FormRequest
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
            'name'        => ['required', 'string', 'min:2', 'max:100', 'unique:ingredients,name,{$this->ingredient->id}'],
            'price'       => ['required', 'integer', 'min:1'],
            'stock'       => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:2000'],
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'Error',
            'message' => 'Datos no Válidos',
            'data'    => $validator->errors()
        ], 422));
    }
}
