<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Ingredient;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Sale;
use App\Models\Potion;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaleCreateTest extends TestCase
{

    use RefreshDatabase;

    public function createPotions($quantityPotions, $quantityIngredients = 1)
    {
        $potions = [];
        for ($i = 0; $i < $quantityPotions; $i++) {
            $potion = Potion::factory()->create();
            $price  = 0;
            for ($x = 0; $x < $quantityIngredients; $x++) {
                $ingredient = Ingredient::factory()->create();
                $quantity   = rand(1, 50) / 10;
                $potion->ingredients()->attach($ingredient->id, ['quantity' => $quantity]);
                $price += $ingredient->price * $quantity;
            }
            $potion->price = round($price);
            $potion->save();
            $potions[] = $potion;
        }
        return $potions;
    }



    /** @test */
    public function testCanCreate()
    {
        $user    = User::factory()->create();
        $potions = $this->createPotions(2);
        $client  = Client::factory()->create();

        $potionsForSale = [];
        foreach ($potions as $potion) {
                            $quantity    = rand(1, 20);
            $potionsForSale[$potion->id] = [
                'potion_id' => $potion->id,
                'quantity'  => $quantity
            ];
        }

        $newSale = [
            'client_id' => $client->id,
            'potions'   => $potionsForSale
        ];

        $potionsSpected = [];
        $saleTotal      = 0;
        foreach ($potions as $potion) {
                            $potionsTotal = $potion->price * $potionsForSale[$potion->id]['quantity'];
            $potionsSpected[]             = [
                "id"          => $potion->id,
                "name"        => $potion->name,
                "description" => $potion->description,
                "quantity"    => $potionsForSale[$potion->id]['quantity'],
                "total"       => $potionsTotal
            ];

            $saleTotal = $saleTotal + $potionsTotal;
        }

        $clientSpected = [
            "id"    => $client->id,
            "name"  => $client->name,
            "email" => $client->email,
        ];

        $this->actingAs($user)
            ->postJson('api/sales', $newSale)
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data'    => [
                    'id',
                    'client_id',
                    'total',
                    'potions'
                ]
            ])
            ->assertJsonFragment([
                'total'     => $saleTotal,
                'client_id' => $client->id,
                "client"    => $clientSpected,
                "potions"   => $potionsSpected
            ]);
    }

    /** @test */
    public function testCantCreateWhenNotLogged()
    {
        $this->postJson('api/sales', [])->assertUnauthorized();
    }


    public function validationProvider()
    {
        return [
            'Client ID is required' => [
                'newSaleData' => [
                    'potions' => [1]
                ],
                'message'       => [
                    'client_id' => ['El campo cliente es obligatorio.']
                ]
            ],
            'Client ID must be integer' => [
                'newSaleData' => [
                    'client_id' => 'texto',
                    'potions'   => [1]
                ],
                'message'       => [
                    'client_id' => ['El campo cliente debe ser un número entero.']
                ]
            ],
            'Client ID must exist in the database' => [
                'newSaleData' => [
                    'client_id' => 1500,
                    'potions'   => [1]
                ],
                'message'       => [
                    'client_id' => ['El cliente no existe.']
                ]
            ],
            'Potions is required' => [
                'newSaleData' => [
                    'client_id' => 1,
                ],
                'message'       => [
                    'potions' => ['El campo potions es obligatorio.']
                ]
            ],
            'Potions cant be empty' => [
                'newSaleData' => [
                    'client_id' => 1,
                    'potions'   => []
                ],
                'message'       => [
                    'potions' => ['El campo potions es obligatorio.']
                ]
            ],
            'Potions must be array' => [
                'newSaleData' => [
                    'client_id' => 1,
                    'potions'   => 'texto'
                ],
                'message'       => [
                    'potions' => ['El campo potions debe ser un array.']
                ]
            ],
            'potions without id' => [
                'newSaleData' => [
                    'client_id' => 1,
                    'potions'   => [
                        [
                            'quantity' => 2
                        ]
                    ]
                ],
                'message'       => [
                    'potions' => [
                        [
                            'potion_id' => ['No se ha seleccionado una posión.']
                        ]
                    ]
                ]
            ],
            'potions id must exist in the database' => [
                'newSaleData' => [
                    'client_id' => 1,
                    'potions'   => [
                        [
                            'potion_id' => 10,
                            'quantity'  => 50.5
                        ]
                    ]
                ],
                'message'       => [
                    'potions' => [
                        [
                            'potion_id' => ['La posión seleccionada no existe.']
                        ]
                    ]
                ]
            ],
            'potions without quantity' => [
                'newSaleData' => [
                    'client_id' => 1,
                    'potions'   => [
                        [
                            'potion_id' => 1,
                        ]
                    ]
                ],
                'message'       => [
                    'potions' => [
                        [
                            'quantity'  => ['No se ha ingresado una cantidad.'],
                            'potion_id' => ['La posión seleccionada no existe.'],
                        ]
                    ]
                ]
            ],
            'potions with invalid quantity' => [
                'newSaleData' => [
                    'client_id' => 1,
                    'potions'   => [
                        [
                            'potion_id' => 1,
                            'quantity'  => 'test'
                        ]
                    ]
                ],
                'message'       => [
                    'potions' => [
                        [
                            'potion_id' => ['La posión seleccionada no existe.'],
                            'quantity'  => ['No se ha ingresado una cantidad válida.', 'La cantidad debe ser mayor a 0.'],
                        ]
                    ]
                ]
            ],
            'potions greater than 0' => [
                'newSaleData' => [
                    'client_id' => 1,
                    'potions'   => [
                        [
                            'potion_id' => 1,
                            'quantity'  => -3
                        ]
                    ]
                ],
                'message'       => [
                    'potions' => [
                        [
                            'potion_id' => ['La posión seleccionada no existe.'],
                            'quantity'  => ['La cantidad debe ser mayor a 0.'],
                        ]
                    ]
                ]
            ],


        ];
    }

    /**
     * @test
     * @dataProvider validationProvider
     * */
    public function testValidation(
        array $newSaleData,
        array $message
    ) {
        $user = User::factory()->create();

        if (isset($newSaleData['client_id']) && is_numeric($newSaleData['client_id']) && $newSaleData['client_id'] < 1000) {
                         $client      = Client::factory()->create();
            $newSaleData['client_id'] = $client->id;
        }

        if (isset($newSaleData['potions']) && is_array($newSaleData['potions']) && count($newSaleData['potions']) && is_numeric($newSaleData['potions'][0])) {
            $potions        = $this->createPotions(2);
            $potionsForSale = [];
            foreach ($potions as $potion) {
                                $quantity    = rand(1, 20);
                $potionsForSale[$potion->id] = [
                    'potion_id' => $potion->id,
                    'quantity'  => $quantity
                ];
            }

            $newSaleData['potions'] = $potionsForSale;
        }

        // dd($newSaleData);

        $resp = $this->actingAs($user)
            ->postJson('api/sales', $newSaleData);
        $resp->assertUnprocessable()
            ->assertExactJson([
                'status'  => 'Error',
                'message' => 'Datos no Válidos',
                'data'    => $message
            ]);
    }


    /** @test */
    public function ingredientsStockValidation()
    {
        $user           = User::factory()->create();
        $client         = Client::factory()->create();
        $potionsForSale = [];


        $potions    = [];
        $potion     = Potion::factory()->create();
        $price      = 0;
        $ingredient = Ingredient::factory()->create(['name' => 'Ingrediente Mágico']);
        $quantity   = 10000;
        $potion->ingredients()->attach($ingredient->id, ['quantity' => $quantity]);
        $price         += $ingredient->price * $quantity;
        $potion->price  = round($price);
        $potion->save();
        $potions[] = $potion;


        foreach ($potions as $potion) {
            $quantity    = rand(1, 20);
            $potionsForSale[$potion->id] = [
                'potion_id' => $potion->id,
                'quantity'  => $quantity
            ];
        }

        $newSaleData = [
            'client_id' => $client->id,
            'potions'   => $potionsForSale,
        ];
        $resp = $this->actingAs($user)
            ->postJson('api/sales', $newSaleData);
        $resp->assertUnprocessable()
            ->assertExactJson([
                'status'  => 'Error',
                'message' => 'Datos no Válidos',
                'data'    => [
                    'potions' => [
                        'No hay suficiente stock de Ingrediente Mágico para preparar las posiones requeridas.'
                    ]
                ]
            ]);
    }
}
