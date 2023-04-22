<?php

namespace App\Http\Requests;

use App\Rules\IngredientInStockRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaleStoreRequest extends FormRequest
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
            'client_id'           => ['required', 'integer', 'exists:App\Models\Client,id'],
            'potions'             => ['required', 'array', new IngredientInStockRule($this->potions)],
            'potions.*'           => ['array'],
            'potions.*.potion_id' => ['required', 'exists:potions,id'],
            'potions.*.quantity'  => ['required', 'numeric', 'gt:0'],
        ];
    }

    public function messages()
    {
        return [
            'client_id.required'           => 'El campo cliente es obligatorio.',
            'client_id.integer'            => 'El campo cliente debe ser un número entero.',
            'client_id.exists'             => 'El cliente no existe.',
            'potions.*.potion_id.required' => 'No se ha seleccionado una posión.',
            'potions.*.potion_id.exists'   => 'La posión seleccionada no existe.',
            'potions.*.quantity.required'  => 'No se ha ingresado una cantidad.',
            'potions.*.quantity.numeric'   => 'No se ha ingresado una cantidad válida.',
            'potions.*.quantity.gt'        => 'La cantidad debe ser mayor a 0.'
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
