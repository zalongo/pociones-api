<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Potion;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PotionUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanUpdate()
    {
        $user                                   = User::factory()->create();
        $potion                                 = Potion::factory()->create();
        $faker                                  = Factory::create();
        [$ingredients, $ingredientsForPosition] = $this->giveMeIngredients(5);

        $newName        = $faker->name;
        $newDescription = $faker->text;

        $potionNewData = [
            'name'        => $newName,
            'description' => $newDescription,
            'ingredients' => $ingredientsForPosition,
        ];

        $resp = $this->actingAs($user)
            ->putJson('api/potions/' . $potion->id, $potionNewData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'id'          => $potion->id,
                'name'        => $potionNewData['name'],
                'description' => $potionNewData['description'],
            ]);
    }


    public function giveMeIngredients($q)
    {
        $ingredients = Ingredient::factory($q)->create();

        $ingredientsForPosition = [];
        foreach ($ingredients->pluck('id')->toArray() as $ingredientId) {
            $ingredientsForPosition[] = [
                "ingredient_id" => $ingredientId,
                "quantity"      => rand(1, 20) / 10
            ];
        }

        return [
            $ingredients,
            $ingredientsForPosition,
        ];
    }


    public function orderIngredientsForResponse($ingredients, $ingredientsPivotData)
    {
        $responseIngredients = [];
        foreach ($ingredients as $key => $ingredient) {
            $responseIngredients[] = [
                "id"          => $ingredient->id,
                "name"        => $ingredient->name,
                "description" => $ingredient->description,
                "quantity"    => $ingredientsPivotData[$key]['quantity']
            ];
        }

        return $responseIngredients;
    }

    /** @test */
    public function testCanUpdateIngredients()
    {
        $user                                   = User::factory()->create();
        $potion                                 = Potion::factory()->create();
        [$ingredients, $ingredientsForPosition] = $this->giveMeIngredients(5);

        $potion->ingredients()->sync($ingredientsForPosition);
        // modifico segundo ingrediente
        $ingredientsForPosition[1]['quantity']++;

        $potionNewData = [
            'name'        => $potion->name,
            'description' => $potion->description,
            'ingredients' => $ingredientsForPosition
        ];

        $responseIngredients = $this->orderIngredientsForResponse($ingredients, $ingredientsForPosition);

        $resp = $this->actingAs($user)
            ->putJson('api/potions/' . $potion->id, $potionNewData);
        $resp->assertStatus(201)
            ->assertJsonFragment([
                'id'          => $potion->id,
                'name'        => $potionNewData['name'],
                'description' => $potionNewData['description'],
                'ingredients' => $responseIngredients
            ]);
    }



    /** @test */
    public function testCanAddIngredients()
    {
        $user                                         = User::factory()->create();
        $potion                                       = Potion::factory()->create();
        [$ingredients, $ingredientsForPosition]       = $this->giveMeIngredients(5);
        [$ingredientsNew, $ingredientsNewForPosition] = $this->giveMeIngredients(1);

        $potion->ingredients()->sync($ingredientsForPosition);
        $ingredientsForPosition = array_merge($ingredientsForPosition, $ingredientsNewForPosition);

        $potionNewData = [
            'name'        => $potion->name,
            'description' => $potion->description,
            'ingredients' => $ingredientsForPosition
        ];

        $responseIngredients    = $this->orderIngredientsForResponse($ingredients, $ingredientsForPosition);
        $responseIngredientsNew = $this->orderIngredientsForResponse($ingredientsNew, $ingredientsNewForPosition);

        $resp = $this->actingAs($user)
            ->putJson('api/potions/' . $potion->id, $potionNewData);
        $resp->assertStatus(201)
            ->assertJsonFragment([
                'id'          => $potion->id,
                'name'        => $potionNewData['name'],
                'description' => $potionNewData['description'],
                'ingredients' => array_merge($responseIngredients, $responseIngredientsNew)
            ]);
    }


    /** @test */
    public function testCanRemoveIngredients()
    {
        $user                                   = User::factory()->create();
        $potion                                 = Potion::factory()->create();
        [$ingredients, $ingredientsForPosition] = $this->giveMeIngredients(15);

        $potion->ingredients()->sync($ingredientsForPosition);

        // remuevo el 7° elemento
        unset($ingredients[6], $ingredientsForPosition[6]);

        $potionNewData = [
            'name'        => $potion->name,
            'description' => $potion->description,
            'ingredients' => $ingredientsForPosition
        ];

        $responseIngredients = $this->orderIngredientsForResponse($ingredients, $ingredientsForPosition);

        $resp = $this->actingAs($user)
            ->putJson('api/potions/' . $potion->id, $potionNewData);
        $resp->assertStatus(201)
            ->assertJsonFragment([
                'id'          => $potion->id,
                'name'        => $potionNewData['name'],
                'description' => $potionNewData['description'],
                'ingredients' => $responseIngredients
            ]);
    }

    /** @test */
    public function testCantUpdateWhenIsNotLogged()
    {
        $potion = Potion::factory()->create();

        $potionNewData = [];
        $response      = $this->putJson('api/potions/' . $potion->id, $potionNewData)
            ->assertUnauthorized();
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
        $potion = Potion::factory()->create();
        $user   = User::factory()->create();

        if (isset($newPotionData['ingredients']) && is_array($newPotionData['ingredients']) && count($newPotionData['ingredients']) && is_numeric($newPotionData['ingredients'][0])) {
                           [$ingredients, $ingredientsForPosition,] = $this->giveMeIngredients(5);
            $newPotionData['ingredients']                           = $ingredientsForPosition;
        }

        $this->actingAs($user)->putJson('api/potions/' . $potion->id, $newPotionData)
            ->assertUnprocessable()
            ->assertExactJson([
                'status'  => 'Error',
                'message' => 'Datos no Válidos',
                'data'    => $message
            ]);
    }
}
