<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->text(10),
            'description' => $this->faker->text(),
            'price'       => $this->faker->numberBetween(100, 5000),
            'stock'       => $this->faker->numberBetween(0, 1000)
        ];
    }
}
