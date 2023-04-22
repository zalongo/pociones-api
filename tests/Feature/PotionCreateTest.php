<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Potion;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PotionCreateTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function testCanCreate()
    {
        $user        = User::factory()->create();
        $faker       = Factory::create();
        $ingredients = Ingredient::factory(5)->create();

        $ingredientsForPosition = [];
        $potionPrice            = 0;
        $ingredientsSpected     = [];
        foreach ($ingredients as $ingredient) {
                                    $quantity     = rand(1, 20) / 10;
                                    $potionPrice += $ingredient->price * $quantity;
            $ingredientsForPosition[]             = [
                "ingredient_id" => $ingredient->id,
                "quantity"      => $quantity
            ];
            $ingredientsSpected[] = [
                "id"          => $ingredient->id,
                "name"        => $ingredient->name,
                "description" => $ingredient->description,
                "quantity"    => $quantity
            ];
        }

        $newPotion = [
            "name"        => $faker->realText(100),
            "description" => $faker->text(2000),
            "ingredients" => $ingredientsForPosition
        ];

        $resp = $this->actingAs($user)
            ->postJson('api/potions', $newPotion)
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data'    => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'ingredients'
                ]
            ])
            ->assertJsonFragment([
                "name"        => $newPotion["name"],
                "description" => $newPotion["description"],
                "ingredients" => $ingredientsSpected,
            ]);
    }

    /** @test */
    public function testCantCreateWhenNotLogged()
    {
        $this->postJson('api/potions', [])->assertUnauthorized();
    }


    public function validationProvider()
    {
        $faker = Factory::create();

        $name        = $faker->realText(100);
        $description = $faker->text(2000);


        return [
            'Name is required' => [
                'newPotionData' => [
                    'description' => $description,
                    'ingredients' => [1]
                ],
                'message'       => [
                    'name' => ['El campo name es obligatorio.']
                ]
            ],
            'Name min 4 caracteres' => [
                'newPotionData' => [
                    "name"        => "L",
                    'description' => $description,
                    'ingredients' => [1]
                ],
                'message'       => [
                    'name' => ['El campo name debe contener al menos 4 caracteres.']
                ]
            ],
            'Name max 100 caracteres' => [
                'newPotionData' => [
                    "name"        => "aaaa aaaaaa aaaaaaaaaaaaaaaaa aaaaaaaaaaaaa aaaaabbbbbbbbbbbb bbbbbbbbbbbbbbbbbbbb bbbbbbbbbbbbbbbbbbbbbb",
                    'description' => $description,
                    'ingredients' => [1]
                ],
                'message'       => [
                    'name' => ['El campo name no debe contener más de 100 caracteres.']
                ]
            ],
            'Description is required' => [
                'newPotionData' => [
                    'name'        => $name,
                    'ingredients' => [1]
                ],
                'message'       => [
                    'description' => ['El campo description es obligatorio.']
                ]
            ],
            'Description min 4 caracteres' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => 'n',
                    'ingredients' => [1]
                ],
                'message'       => [
                    'description' => ['El campo description debe contener al menos 4 caracteres.']
                ]
            ],
            'ingredients is required' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => $description,
                ],
                'message'       => [
                    'ingredients' => ['El campo ingredients es obligatorio.']
                ]
            ],
            'ingredients cant be empty' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => $description,
                    'ingredients' => []
                ],
                'message'       => [
                    'ingredients' => ['El campo ingredients es obligatorio.']
                ]
            ],
            'ingredients cant be empty' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => $description,
                    'ingredients' => 'texto'
                ],
                'message'       => [
                    'ingredients' => ['El campo ingredients debe ser un array.']
                ]
            ],

            'ingredients without id' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => $description,
                    'ingredients' => [
                        [
                            'quantity' => 50.5
                        ]
                    ]
                ],
                'message'       => [
                    'ingredients' => [
                        [
                            'ingredient_id' => ['No se ha seleccionado un ingrediente.']
                        ]
                    ]
                ]
            ],


            'ingredients id isnt in database' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => $description,
                    'ingredients' => [
                        [
                            'ingredient_id' => 10,
                            'quantity'      => 50.5
                        ]
                    ]
                ],
                'message'       => [
                    'ingredients' => [
                        [
                            'ingredient_id' => ['El ingrediente seleccionado no existe.']
                        ]
                    ]
                ]
            ],

            'ingredients without quantity' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => $description,
                    'ingredients' => [
                        [
                            'ingredient_id' => 1,
                        ]
                    ]
                ],
                'message'       => [
                    'ingredients' => [
                        [
                            'quantity'      => ['No se ha ingresado una cantidad.'],
                            'ingredient_id' => ['El ingrediente seleccionado no existe.'],
                        ]
                    ]
                ]
            ],

            'ingredients with invalid quantity' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => $description,
                    'ingredients' => [
                        [
                            'ingredient_id' => 1,
                            'quantity'      => 'test'
                        ]
                    ]
                ],
                'message'       => [
                    'ingredients' => [
                        [
                            'ingredient_id' => ['El ingrediente seleccionado no existe.'],
                            'quantity'      => ['No se ha ingresado una cantidad válida.', 'La cantidad debe ser mayor a 0.'],
                        ]
                    ]
                ]
            ],

            'ingredients greater than 0' => [
                'newPotionData' => [
                    'name'        => $name,
                    'description' => $description,
                    'ingredients' => [
                        [
                            'ingredient_id' => 1,
                            'quantity'      => -3
                        ]
                    ]
                ],
                'message'       => [
                    'ingredients' => [
                        [
                            'ingredient_id' => ['El ingrediente seleccionado no existe.'],
                            'quantity'      => ['La cantidad debe ser mayor a 0.'],
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
        array $newPotionData,
        array $message
    ) {
        $user = User::factory()->create();


        if (isset($newPotionData['ingredients']) && is_array($newPotionData['ingredients']) && count($newPotionData['ingredients']) && is_numeric($newPotionData['ingredients'][0])) {
            $ingredientsForPosition = [];
            $ingredients            = Ingredient::factory(5)->create();
            foreach ($ingredients->pluck('id')->toArray() as $ingredientId) {
                $ingredientsForPosition[] = [
                    "ingredient_id" => $ingredientId,
                    "quantity"      => rand(1, 20) / 10
                ];
            }
            $newPotionData['ingredients'] = $ingredientsForPosition;
        }

        $resp = $this->actingAs($user)
            ->postJson('api/potions', $newPotionData);
        $resp->assertUnprocessable()
            ->assertExactJson([
                'status'  => 'Error',
                'message' => 'Datos no Válidos',
                'data'    => $message
            ]);
    }
}
