<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                'name'       => 'Elly Kedward',
                'email'      => 'ekedward@heyfoodie.cl',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name'       => 'Alice Kyteler',
                'email'      => 'akyteler@heyfoodie.cl',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name'       => 'Madame Blavatsky',
                'email'      => 'mblavatsky@heyfoodie.cl',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
            [
                'name'       => 'Joan Wytte',
                'email'      => 'jwytte@heyfoodie.cl',
                'created_at' => '2022-07-28 22:34:51',
                'updated_at' => '2022-07-28 22:34:51'
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}