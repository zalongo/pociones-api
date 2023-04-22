<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'price'       => 0
        ];
    }
}
