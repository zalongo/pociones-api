<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Potion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PotionSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $potion   = Potion::factory()->create();
        $quantity = $this->faker->numberBetween(1, 5);
        $total    = $potion[0]->price * $quantity;
        return [
            'potion_id' => $potion,
            'sale_id'   => Sale::factory(),
            'quantity'  => $quantity,
            'total'     => $total,
        ];
    }
}
