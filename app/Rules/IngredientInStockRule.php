<?php

namespace App\Rules;

use App\Models\Potion;
use App\Http\Resources\SaleResource;
use Illuminate\Contracts\Validation\Rule;

class IngredientInStockRule implements Rule
{

    private $potions, $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($potions)
    {
        $this->potions = $potions;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_array($this->potions)) {
            foreach ($this->potions as $potionData) {

                $potion_id       = isset($potionData['potion_id']) ? $potionData['potion_id'] : null;
                $potion_quantity = isset($potionData['quantity']) ? $potionData['quantity'] : null;

                $potion      = Potion::with('ingredients')->find($potion_id);
                $ingredients = [];
                if ($potion && $potion_quantity) {
                    $potion = SaleResource::make($potion);
                    foreach ($potion->ingredients as $ingredient) {
                        $totalQuantityForThisPotion = $ingredient->pivot->quantity * $potion_quantity;
                        if (!isset($ingredients[$ingredient->id])) {
                            $ingredients[$ingredient->id] = [
                                'stock'  => $ingredient->stock,
                                'amount' => $totalQuantityForThisPotion
                            ];
                        } else {
                            $ingredients[$ingredient->id] = [
                                'amount' => $ingredients[$ingredient->id]['amount'] + $totalQuantityForThisPotion
                            ];
                        }

                        if ($ingredients[$ingredient->id]['stock'] < $ingredients[$ingredient->id]['amount']) {
                            $this->setMessage('No hay suficiente stock de ' . $ingredient->name . ' para preparar las pociones requeridas.');
                            return false;
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message ?? 'No hay suficiente stock de algunos ingredientes para preparar las pociones.';
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}
