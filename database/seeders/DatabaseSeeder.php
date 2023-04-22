<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClientSeeder::class,
            PotionSeeder::class,
            IngredientSeeder::class,
            IngredientPotionSeeder::class,
            SaleSeeder::class,
            UserSeeder::class
        ]);
    }
}