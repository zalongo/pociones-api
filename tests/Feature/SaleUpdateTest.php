<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\Sale;
use App\Models\User;
use App\Models\Client;
use App\Models\Potion;
use App\Models\Ingredient;
use App\Models\PotionSale;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaleUpdateTest extends TestCase
{
    use RefreshDatabase;

    private $potions = [], $potionsTotal = 0;


    public function createPotions($quantityPotions)
    {
        $this->potions = [];
        for ($i = 0; $i < $quantityPotions; $i++) {
            $potion              = Potion::factory()->create();
            $quantityIngredients = rand(2, 20);
            $ingredients         = Ingredient::factory($quantityIngredients)->create();
            $quantity            = rand(1, 50) / 10;
            $potion->ingredients()->attach($ingredients->pluck('id')->toArray(), ['quantity' => $quantity]);
            $price = 0;
            foreach ($ingredients as $ingredient) {
                $price += $ingredient->price * $quantity;
            }
            $potion->price = round($price);
            $potion->save();


            $quantityThisPotion = rand(1, 5);
            $total              = intval($potion->price * $quantityThisPotion);

            $this->potions[] = [
                "id"          => $potion->id,
                "name"        => $potion->name,
                "description" => $potion->description,
                "quantity"    => $quantityThisPotion,
                "total"       => $total
            ];
        }

        return $this->potions;
    }

    public function getPotionsTotal()
    {
        $this->potionsTotal = 0;
        foreach ($this->potions as $potion) {
            $this->potionsTotal = $this->potionsTotal + $potion['total'];
        }
        return $this->potionsTotal;
    }

    public function addPotionsToSale($sale)
    {
        foreach ($this->potions as $potion) {
            PotionSale::create([
                'potion_id' => $potion['id'],
                'sale_id'   => $sale->id,
                'quantity'  => $potion['quantity'],
                'total'     => $potion['total'],
            ]);
        }
    }

    /** @test */
    public function testCanUpdateClient()
    {
        $user   = User::factory()->create();
        $client = Client::factory(2)->create();
        $sale   = Sale::factory()->create([
            'client_id' => $client[0]->id
        ]);

        $this->createPotions(rand(1, 5));
        $this->addPotionsToSale($sale);
        $sale->total = $this->getPotionsTotal();
        $sale->save();

        $saleNewData = [
            'client_id' => $client[1]->id,
        ];

        $resp = $this->actingAs($user)
            ->putJson('api/sales/' . $sale->id, $saleNewData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'Venta actualizada con éxito.',
                'id'        => $sale->id,
                'total'     => $sale->total,
                'client_id' => $client[1]->id,
                "client"    => [
                    "id"    => $client[1]->id,
                    "name"  => $client[1]->name,
                    "email" => $client[1]->email,
                ],
                "potions" => $this->potions
            ]);
    }

    /** @test */
    public function testCanReplaceAllPotions()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();
        $sale   = Sale::factory()->create([
            'client_id' => $client->id
        ]);

        $this->createPotions(rand(1, 20));
        $this->addPotionsToSale($sale);
        $sale->total       = $this->getPotionsTotal();
        $sale->save();

        $this->createPotions(rand(1, 20));
        $newPotionsForSale = [];
        foreach ($this->potions as $potion) {
            $newPotionsForSale[] = [
                'potion_id' => $potion['id'],
                'quantity' => $potion['quantity'],
            ];
        }

        $saleNewData = [
            'client_id' => $client->id,
            'potions' => $newPotionsForSale
        ];


        $this->getPotionsTotal();
        $resp = $this->actingAs($user)
            ->putJson('api/sales/' . $sale->id, $saleNewData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'Venta actualizada con éxito.',
                'id'        => $sale->id,
                'total'     => $this->potionsTotal,
                'client_id' => $client->id,
                "client"    => [
                    "id"    => $client->id,
                    "name"  => $client->name,
                    "email" => $client->email,
                ],
                "potions" => $this->potions
            ]);
    }



    /** @test */
    public function testCanAddPotions()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();
        $sale   = Sale::factory()->create([
            'client_id' => $client->id
        ]);

        $actualPotions = $this->createPotions(rand(1, 20));
        $this->addPotionsToSale($sale);
        $sale->total = $this->getPotionsTotal();
        $sale->save();

        $newPotions = $this->createPotions(rand(1, 2));
        $newPotionsForSale = [];
        $newTotal  = 0;
        foreach ($actualPotions as $potion) {
            $newPotionsForSale[] = [
                'potion_id' => $potion['id'],
                'quantity' => $potion['quantity'],
            ];
            $newTotal += $potion['total'];
        }

        foreach ($newPotions as $potion) {
            $newPotionsForSale[] = [
                'potion_id' => $potion['id'],
                'quantity' => $potion['quantity'],
            ];
            $newTotal += $potion['total'];
        }

        $saleNewData = [
            'client_id' => $client->id,
            'potions' => $newPotionsForSale
        ];


        $this->getPotionsTotal();
        $resp = $this->actingAs($user)
            ->putJson('api/sales/' . $sale->id, $saleNewData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'Venta actualizada con éxito.',
                'id'        => $sale->id,
                'total'     => $newTotal,
                'client_id' => $client->id,
                "client"    => [
                    "id"    => $client->id,
                    "name"  => $client->name,
                    "email" => $client->email,
                ],
                "potions" => array_merge($actualPotions, $newPotions)
            ]);
    }


    /** @test */
    public function testCanRemovePotions()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();
        $sale   = Sale::factory()->create([
            'client_id' => $client->id
        ]);

        $this->createPotions(rand(2, 2));
        $this->addPotionsToSale($sale);
        $sale->total       = $this->getPotionsTotal();
        $sale->save();

        $newPotionsForSale = [];
        unset($this->potions[0]);
        $this->potions = array_values($this->potions);
        foreach ($this->potions as $potion) {
            $newPotionsForSale[] = [
                'potion_id' => $potion['id'],
                'quantity' => $potion['quantity'],
            ];
        }

        $saleNewData = [
            'client_id' => $client->id,
            'potions' => $newPotionsForSale
        ];


        $this->getPotionsTotal();
        $resp = $this->actingAs($user)
            ->putJson('api/sales/' . $sale->id, $saleNewData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'Venta actualizada con éxito.',
                'id'        => $sale->id,
                'total'     => $this->potionsTotal,
                'client_id' => $client->id,
                "client"    => [
                    "id"    => $client->id,
                    "name"  => $client->name,
                    "email" => $client->email,
                ],
                "potions" => $this->potions
            ]);
    }



    /** @test */
    public function testCanModifyPotion()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();
        $sale   = Sale::factory()->create([
            'client_id' => $client->id
        ]);

        $this->createPotions(rand(1, 2));
        $this->addPotionsToSale($sale);
        $sale->total = $this->getPotionsTotal();
        $sale->save();

        $newPotionsForSale = [];
        $potionPrice = $this->potions[0]['total'] / $this->potions[0]['quantity'];
        $this->potions[0]['quantity'] = $this->potions[0]['quantity'] + 1;
        $newPotionTotal = $potionPrice * $this->potions[0]['quantity'];
        $this->potions[0]['total'] = $newPotionTotal;
        foreach ($this->potions as $potion) {
            $newPotionsForSale[] = [
                'potion_id' => $potion['id'],
                'quantity' => $potion['quantity'],
            ];
        }

        $saleNewData = [
            'client_id' => $client->id,
            'potions' => $newPotionsForSale
        ];

        $this->getPotionsTotal();
        $resp = $this->actingAs($user)
            ->putJson('api/sales/' . $sale->id, $saleNewData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'Venta actualizada con éxito.',
                'id'        => $sale->id,
                'total'     => $this->potionsTotal,
                'client_id' => $client->id,
                "client"    => [
                    "id"    => $client->id,
                    "name"  => $client->name,
                    "email" => $client->email,
                ],
                "potions" => $this->potions
            ]);
    }

    /** @test */
    public function testCantUpdateWhenIsNotLogged()
    {
        $sale = Sale::factory()->create();

        $saleNewData = [];
        $response = $this->putJson('api/sales/' . $sale->id, $saleNewData)
            ->assertUnauthorized();
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
            // 'Potions is required' => [
            //     'newSaleData' => [
            //         'client_id' => 1,
            //     ],
            //     'message'       => [
            //         'potions' => ['El campo potions es obligatorio.']
            //     ]
            // ],
            // 'Potions cant be empty' => [
            //     'newSaleData' => [
            //         'client_id' => 1,
            //         'potions'   => []
            //     ],
            //     'message'       => [
            //         'potions' => ['El campo potions es obligatorio.']
            //     ]
            // ],
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

        $client = Client::factory()->create();
        $sale   = Sale::factory()->create([
            'client_id' => $client->id
        ]);

        $this->createPotions(rand(2, 2));
        $this->addPotionsToSale($sale);
        $sale->total       = $this->getPotionsTotal();
        $sale->save();

        if (isset($newSaleData['client_id']) && is_numeric($newSaleData['client_id']) && $newSaleData['client_id'] < 1000) {
            $client      = Client::factory()->create();
            $newSaleData['client_id'] = $client->id;
        }

        if (isset($newSaleData['potions']) && is_array($newSaleData['potions']) && count($newSaleData['potions']) && is_numeric($newSaleData['potions'][0])) {
            $potions        = $this->createPotions($newSaleData['potions'][0]);
            $potionsForSale = [];
            foreach ($potions as $potion) {
                $quantity    = rand(1, 20);
                $potionsForSale[$potion['id']] = [
                    'potion_id' => $potion['id'],
                    'quantity'  => $quantity
                ];
            }

            $newSaleData['potions'] = $potionsForSale;
        }

        $this->actingAs($user)->putJson('api/sales/' . $sale->id, $newSaleData)
            ->assertUnprocessable()
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


        $sale   = Sale::factory()->create([
            'client_id' => $client->id
        ]);
        $potion     = Potion::factory()->create();
        $ingredient = Ingredient::factory()->create(['name' => 'Ingrediente Mágico']);
        $potion->ingredients()->attach($ingredient->id, ['quantity' => 1]);
        $price         = $ingredient->price;
        $potion->price  = round($price);
        $potion->save();
        $sale->total = $price;
        $sale->save();

        $newPotionsForSale[] = [
            'potion_id' => $potion->id,
            'quantity' => 1000,
        ];

        $saleNewData = [
            'client_id' => $client->id,
            'potions' => $newPotionsForSale
        ];

        $resp = $this->actingAs($user)
            ->putJson('api/sales/' . $sale->id, $saleNewData)
            ->assertUnprocessable()
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





    public function providerInvalidSaleId()
    {
        return [
            'Sale id negative' => ['-1'],
            'Sale id zero' => ['0'],
            'Sale id non exist' => ['5000000'],
            'Sale id string' => ['stringText'],
        ];
    }

    /**
     * @test
     * @dataProvider providerInvalidSaleId
     * */
    public function testCantUpdateSale(string $saleId)
    {
        $user   = User::factory()->create();

        $user = User::factory()->create();
        $newSale = [
            "name" => "Este es el nombre",
            "email" => "test@test.cl"
        ];
        $this->actingAs($user)
            ->putJson('api/sales/' . $saleId, $newSale)
            ->assertNotFound();
    }
}
