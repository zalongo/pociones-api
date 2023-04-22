<?php

namespace Database\Seeders;

use App\Models\Potion;
use Illuminate\Database\Seeder;

class PotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $potions = [
            [
                'name'       => 'Poción De Amor',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name'       => 'Poción Alisadora',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name'       => 'Poción Multijugos',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
        ];

        foreach ($potions as $potion) {
            Potion::create($potion);
        }
    }
}