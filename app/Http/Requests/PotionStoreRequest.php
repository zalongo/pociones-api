<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PotionStoreRequest extends FormRequest
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
            'name'                        => ['required', 'string', 'min:4', 'max:100', 'unique:potions'],
            'description'                 => ['required', 'string', 'min:4', 'max:2000'],
            'ingredients'                 => ['required', 'array'],
            'ingredients.*'               => ['array'],
            'ingredients.*.ingredient_id' => ['required', 'exists:ingredients,id'],
            'ingredients.*.quantity'      => ['required', 'numeric', 'gt:0'],
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


    public function messages()
    {
        return [
            'ingredients.*.ingredient_id.required' => 'No se ha seleccionado un ingrediente.',
            'ingredients.*.ingredient_id.exists'   => 'El ingrediente seleccionado no existe.',
            'ingredients.*.quantity.required'      => 'No se ha ingresado una cantidad.',
            'ingredients.*.quantity.numeric'       => 'No se ha ingresado una cantidad válida.',
            'ingredients.*.quantity.gt'            => 'La cantidad debe ser mayor a 0.'
        ];
    }
}
