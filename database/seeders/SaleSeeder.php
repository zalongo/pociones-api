<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales = [
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '6',
                'total'      => '72600',
                'created_at' => '2021-10-11 17:04:16',
                'updated_at' => '2021-10-11 17:04:16'
            ],
            [
                'client_id'  => '2',
                'potion_id'  => '2',
                'quantity'   => '12',
                'total'      => '122400',
                'created_at' => '2021-09-15 19:33:24',
                'updated_at' => '2021-09-15 19:33:24'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '1',
                'quantity'   => '30',
                'total'      => '363000',
                'created_at' => '2021-10-06 17:34:33',
                'updated_at' => '2021-10-06 17:34:33'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '2',
                'quantity'   => '5',
                'total'      => '51000',
                'created_at' => '2021-10-12 18:37:00',
                'updated_at' => '2021-10-12 18:37:00'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '3',
                'total'      => '36300',
                'created_at' => '2021-10-06 17:34:33',
                'updated_at' => '2021-10-06 17:34:33'
            ],
            [
                'client_id'  => '2',
                'potion_id'  => '1',
                'quantity'   => '5',
                'total'      => '60500',
                'created_at' => '2021-09-15 19:33:24',
                'updated_at' => '2021-09-15 19:33:24'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '2',
                'quantity'   => '9',
                'total'      => '91800',
                'created_at' => '2021-10-14 13:32:59',
                'updated_at' => '2021-10-14 13:32:59'
            ],
            [
                'client_id'  => '2',
                'potion_id'  => '1',
                'quantity'   => '18',
                'total'      => '217800',
                'created_at' => '2021-10-12 18:37:00',
                'updated_at' => '2021-10-12 18:37:00'
            ],
            [
                'client_id'  => '2',
                'potion_id'  => '1',
                'quantity'   => '30',
                'total'      => '363000',
                'created_at' => '2021-10-14 13:32:59',
                'updated_at' => '2021-10-14 13:32:59'
            ],
            [
                'client_id'  => '2',
                'potion_id'  => '2',
                'quantity'   => '1',
                'total'      => '10200',
                'created_at' => '2021-10-11 17:04:16',
                'updated_at' => '2021-10-11 17:04:16'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '2',
                'quantity'   => '2',
                'total'      => '20400',
                'created_at' => '2021-09-13 20:48:48',
                'updated_at' => '2021-09-13 20:48:48'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '3',
                'quantity'   => '6',
                'total'      => '110100',
                'created_at' => '2021-10-01 19:35:59',
                'updated_at' => '2021-10-01 19:35:59'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '22',
                'total'      => '266200',
                'created_at' => '2021-09-13 20:48:48',
                'updated_at' => '2021-09-13 20:48:48'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '21',
                'total'      => '254100',
                'created_at' => '2021-10-01 19:35:59',
                'updated_at' => '2021-10-01 19:35:59'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '2',
                'quantity'   => '7',
                'total'      => '71400',
                'created_at' => '2021-09-16 19:48:34',
                'updated_at' => '2021-09-16 19:48:34'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '3',
                'quantity'   => '1',
                'total'      => '18350',
                'created_at' => '2021-09-22 20:59:28',
                'updated_at' => '2021-09-22 20:59:28'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '5',
                'total'      => '60500',
                'created_at' => '2021-09-22 20:59:28',
                'updated_at' => '2021-09-22 20:59:28'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '1',
                'quantity'   => '8',
                'total'      => '96800',
                'created_at' => '2021-09-16 19:48:34',
                'updated_at' => '2021-09-16 19:48:34'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '1',
                'quantity'   => '42',
                'total'      => '508200',
                'created_at' => '2021-09-15 18:06:10',
                'updated_at' => '2021-09-15 18:06:10'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '12',
                'total'      => '145200',
                'created_at' => '2021-09-15 18:06:10',
                'updated_at' => '2021-09-15 18:06:10'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '3',
                'quantity'   => '13',
                'total'      => '238550',
                'created_at' => '2021-09-19 21:45:35',
                'updated_at' => '2021-09-19 21:45:35'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '2',
                'quantity'   => '35',
                'total'      => '357000',
                'created_at' => '2021-10-03 15:22:59',
                'updated_at' => '2021-10-03 15:22:59'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '2',
                'quantity'   => '33',
                'total'      => '336600',
                'created_at' => '2021-09-19 21:45:35',
                'updated_at' => '2021-09-19 21:45:35'
            ],
            [
                'client_id'  => '2',
                'potion_id'  => '2',
                'quantity'   => '13',
                'total'      => '132600',
                'created_at' => '2021-10-03 15:22:59',
                'updated_at' => '2021-10-03 15:22:59'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '1',
                'quantity'   => '22',
                'total'      => '266200',
                'created_at' => '2021-09-27 19:06:41',
                'updated_at' => '2021-09-27 19:06:41'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '1',
                'quantity'   => '45',
                'total'      => '544500',
                'created_at' => '2021-09-27 19:06:41',
                'updated_at' => '2021-09-27 19:06:41'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '2',
                'quantity'   => '5',
                'total'      => '51000',
                'created_at' => '2021-09-15 13:28:12',
                'updated_at' => '2021-09-15 13:28:12'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '2',
                'quantity'   => '13',
                'total'      => '132600',
                'created_at' => '2021-09-15 13:28:12',
                'updated_at' => '2021-09-15 13:28:12'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '2',
                'quantity'   => '54',
                'total'      => '550800',
                'created_at' => '2021-10-18 20:49:23',
                'updated_at' => '2021-10-18 20:49:23'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '95',
                'total'      => '1149500',
                'created_at' => '2021-10-18 20:49:23',
                'updated_at' => '2021-10-18 20:49:23'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '3',
                'quantity'   => '33',
                'total'      => '605550',
                'created_at' => '2021-09-22 21:33:21',
                'updated_at' => '2021-09-22 21:33:21'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '2',
                'quantity'   => '13',
                'total'      => '132600',
                'created_at' => '2021-09-22 21:33:21',
                'updated_at' => '2021-09-22 21:33:21'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '1',
                'quantity'   => '15',
                'total'      => '181500',
                'created_at' => '2021-09-23 20:04:55',
                'updated_at' => '2021-09-23 20:04:55'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '1',
                'quantity'   => '17',
                'total'      => '205700',
                'created_at' => '2021-09-23 20:04:55',
                'updated_at' => '2021-09-23 20:04:55'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '3',
                'quantity'   => '19',
                'total'      => '348650',
                'created_at' => '2021-09-23 18:08:52',
                'updated_at' => '2021-09-23 18:08:52'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '2',
                'quantity'   => '21',
                'total'      => '214200',
                'created_at' => '2021-09-23 18:08:52',
                'updated_at' => '2021-09-23 18:08:52'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '3',
                'quantity'   => '23',
                'total'      => '422050',
                'created_at' => '2021-10-06 18:52:48',
                'updated_at' => '2021-10-06 18:52:48'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '1',
                'quantity'   => '25',
                'total'      => '302500',
                'created_at' => '2021-10-06 18:52:48',
                'updated_at' => '2021-10-06 18:52:48'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '3',
                'quantity'   => '27',
                'total'      => '495450',
                'created_at' => '2021-10-17 22:00:03',
                'updated_at' => '2021-10-17 22:00:03'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '3',
                'quantity'   => '22',
                'total'      => '403700',
                'created_at' => '2021-10-17 22:00:03',
                'updated_at' => '2021-10-17 22:00:03'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '1',
                'quantity'   => '17',
                'total'      => '205700',
                'created_at' => '2021-10-09 16:43:11',
                'updated_at' => '2021-10-09 16:43:11'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '2',
                'quantity'   => '12',
                'total'      => '122400',
                'created_at' => '2021-10-09 16:43:11',
                'updated_at' => '2021-10-09 16:43:11'
            ],
            [
                'client_id'  => '2',
                'potion_id'  => '3',
                'quantity'   => '7',
                'total'      => '128450',
                'created_at' => '2021-10-18 22:00:03',
                'updated_at' => '2021-10-18 22:00:03'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '2',
                'quantity'   => '2',
                'total'      => '20400',
                'created_at' => '2021-10-18 22:00:03',
                'updated_at' => '2021-10-18 22:00:03'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '3',
                'quantity'   => '14',
                'total'      => '256900',
                'created_at' => '2021-10-10 16:43:11',
                'updated_at' => '2021-10-10 16:43:11'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '22',
                'total'      => '266200',
                'created_at' => '2021-10-10 16:43:11',
                'updated_at' => '2021-10-10 16:43:11'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '3',
                'quantity'   => '1',
                'total'      => '18350',
                'created_at' => '2021-10-19 22:00:03',
                'updated_at' => '2021-10-19 22:00:03'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '3',
                'quantity'   => '3',
                'total'      => '55050',
                'created_at' => '2021-10-19 22:00:03',
                'updated_at' => '2021-10-19 22:00:03'
            ],
            [
                'client_id'  => '1',
                'potion_id'  => '1',
                'quantity'   => '9',
                'total'      => '108900',
                'created_at' => '2021-10-11 16:43:11',
                'updated_at' => '2021-10-11 16:43:11'
            ],
            [
                'client_id'  => '4',
                'potion_id'  => '3',
                'quantity'   => '15',
                'total'      => '275250',
                'created_at' => '2021-10-11 16:43:11',
                'updated_at' => '2021-10-11 16:43:11'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '2',
                'quantity'   => '18',
                'total'      => '183600',
                'created_at' => '2021-10-20 22:00:03',
                'updated_at' => '2021-10-20 22:00:03'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '1',
                'quantity'   => '33',
                'total'      => '399300',
                'created_at' => '2021-10-20 22:00:03',
                'updated_at' => '2021-10-20 22:00:03'
            ],
            [
                'client_id'  => '2',
                'potion_id'  => '1',
                'quantity'   => '22',
                'total'      => '266200',
                'created_at' => '2021-10-12 16:43:11',
                'updated_at' => '2021-10-12 16:43:11'
            ],
            [
                'client_id'  => '3',
                'potion_id'  => '3',
                'quantity'   => '11',
                'total'      => '201850',
                'created_at' => '2021-10-12 16:43:11',
                'updated_at' => '2021-10-12 16:43:11'
            ],
        ];

        foreach ($sales as $sale) {
            Sale::create($sale);
        }
    }
}