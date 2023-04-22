<?php

namespace Database\Seeders;

use App\Models\IngredientPotion;
use Illuminate\Database\Seeder;

class IngredientPotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $potionsIngredients = [
            [
                'potion_id'     => '1',
                'ingredient_id' => '1',
                'quantity'      => '0.2',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '1',
                'ingredient_id' => '2',
                'quantity'      => '0.1',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '1',
                'ingredient_id' => '3',
                'quantity'      => '0.4',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '1',
                'ingredient_id' => '4',
                'quantity'      => '0.3',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '2',
                'ingredient_id' => '5',
                'quantity'      => '0.3',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '2',
                'ingredient_id' => '6',
                'quantity'      => '0.3',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '2',
                'ingredient_id' => '7',
                'quantity'      => '0.1',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '2',
                'ingredient_id' => '8',
                'quantity'      => '0.3',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '3',
                'ingredient_id' => '9',
                'quantity'      => '0.2',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '3',
                'ingredient_id' => '10',
                'quantity'      => '0.1',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '3',
                'ingredient_id' => '7',
                'quantity'      => '0.3',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '3',
                'ingredient_id' => '4',
                'quantity'      => '0.2',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '3',
                'ingredient_id' => '2',
                'quantity'      => '0.1',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],

            [
                'potion_id'     => '3',
                'ingredient_id' => '5',
                'quantity'      => '0.1',
                'created_at'    => '2022-07-28 22:41:10',
                'updated_at'    => '2022-07-28 22:41:10'
            ],



        ];

        foreach ($potionsIngredients as $potionIngredient) {
            IngredientPotion::create($potionIngredient);
        }
    }
}