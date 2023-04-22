<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            [
                'name' => 'Pétalos',
                'price' => '2000',
                'stock' => '13',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Sal De Mar',
                'price' => '3000',
                'stock' => '15',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Vino',
                'price' => '6000',
                'stock' => '20',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Polvo Mágico',
                'price' => '30000',
                'stock' => '20',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Cenizas',
                'price' => '2500',
                'stock' => '6',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Aloe Vera',
                'price' => '1500',
                'stock' => '18',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Lagrima De Gato',
                'price' => '9000',
                'stock' => '12',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Jugo Mágico',
                'price' => '27000',
                'stock' => '10',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Sanguijuelas',
                'price' => '13000',
                'stock' => '15',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name' => 'Polvo De Cuerno De Bicornio',
                'price' => '65000',
                'stock' => '19',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}