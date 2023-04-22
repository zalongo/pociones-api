<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanUpdate()
    {
        $user       = User::factory()->create();
        $ingredient = Ingredient::factory()->create();
        $faker      = Factory::create();

        $newName        = $faker->name;
        $newDescription = $faker->text;
        $newPrice       = $faker->numberBetween(100, 5000);
        $newStock       = $faker->numberBetween(0, 1000);

        $ingredientNewData = [
            'name'        => $newName,
            'description' => $newDescription,
            'price'       => $newPrice,
            'stock'       => $newStock,
        ];
        $this->actingAs($user)
            ->putJson('api/ingredients/' . $ingredient->id, $ingredientNewData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'id'          => $ingredient->id,
                'name'        => $ingredientNewData['name'],
                'description' => $ingredientNewData['description'],
                'price'       => $ingredientNewData['price'],
                'stock'       => $ingredientNewData['stock'],
            ]);
    }

    /** @test */
    public function testCantUpdateWhenIsNotLogged()
    {
        $ingredient = Ingredient::factory()->create();

        $ingredientNewData = [];
        $this->putJson('api/ingredients/' . $ingredient->id, $ingredientNewData)
            ->assertUnauthorized();
    }


    public function validationProvider()
    {
        $faker = Factory::create();

        $name        = $faker->realText(100);
        $price       = $faker->numberBetween(2, 100);
        $description = $faker->text(2000);
        $stock       = $faker->numberBetween(1, 10000);

        return [
            'Name is required' => [
                'newIngredientData' => [
                    'description' => $description,
                    'price'       => $price,
                    'stock'       => $stock
                ],
                'message'       => [
                    'name' => ['El campo name es obligatorio.']
                ]
            ],
            'Name min 2 caracteres' => [
                'newIngredientData' => [
                    "name"        => "L",
                    'description' => $description,
                    'price'       => $price,
                    'stock'       => $stock
                ],
                'message'       => [
                    'name' => ['El campo name debe contener al menos 2 caracteres.']
                ]
            ],
            'Name max 100 caracteres' => [
                'newIngredientData' => [
                    "name"        => "aaaa aaaaaa aaaaaaaaaaaaaaaaa aaaaaaaaaaaaa aaaaabbbbbbbbbbbb bbbbbbbbbbbbbbbbbbbb bbbbbbbbbbbbbbbbbbbbbb",
                    'description' => $description,
                    'price'       => $price,
                    'stock'       => $stock
                ],
                'message'       => [
                    'name' => ['El campo name no debe contener más de 100 caracteres.']
                ]
            ],
            'Price is required' => [
                'newIngredientData' => [
                    "name"        => $name,
                    'description' => $description,
                    'stock'       => $stock
                ],
                'message'       => [
                    'price' => ['El campo price es obligatorio.']
                ]
            ],
            'Price more than 0' => [
                'newIngredientData' => [
                    "name"        => $name,
                    'description' => $description,
                    'price'       => 0,
                    'stock'       => $stock
                ],
                'message'       => [
                    'price' => ['El campo price debe ser al menos 1.']
                ]
            ],
            'Price can´t be string' => [
                'newIngredientData' => [
                    "name"        => $name,
                    'description' => $description,
                    'price'       => 'string',
                    'stock'       => $stock
                ],
                'message'       => [
                    'price' => ['El campo price debe ser un número entero.']
                ]
            ],
            'Stock is required' => [
                'newIngredientData' => [
                    "name"        => $name,
                    'description' => $description,
                    'price'       => $price,
                ],
                'message'       => [
                    'stock' => ['El campo stock es obligatorio.']
                ]
            ],
            'Price equal or more than 0' => [
                'newIngredientData' => [
                    "name"        => $name,
                    'description' => $description,
                    'price'       => $price,
                    'stock'       => -1
                ],
                'message'       => [
                    'stock' => ['El campo stock debe ser al menos 0.']
                ]
            ],
            'Price can´t be string' => [
                'newIngredientData' => [
                    "name"        => $name,
                    'description' => $description,
                    'price'       => $price,
                    'stock'       => 'string'
                ],
                'message'       => [
                    'stock' => ["El campo stock debe ser un número entero."]
                ]
            ],
            'Description max 2000 caracteres' => [
                'newIngredientData' => [
                    "name"        => $name,
                    'description' => $faker->text(2500),
                    'price'       => $price,
                    'stock'       => $stock
                ],
                'message'       => [
                    'description' => ['El campo description no debe contener más de 2000 caracteres.']
                ]
            ],

        ];
    }

    /**
     * @test
     * @dataProvider validationProvider
     * */
    public function testValidation(
        array $newIngredientData,
        array $message
    ) {
        $ingredient = Ingredient::factory()->create();
        $user       = User::factory()->create();

        $this->actingAs($user)->putJson('api/ingredients/' . $ingredient->id, $newIngredientData)
            ->assertUnprocessable()
            ->assertExactJson([
                'status'  => 'Error',
                'message' => 'Datos no Válidos',
                'data'    => $message
            ]);
    }

    public function providerInvalidIngredientId()
    {
        return [
            'Ingredient id negative'  => ['-1'],
            'Ingredient id zero'      => ['0'],
            'Ingredient id non exist' => ['5000000'],
            'Ingredient id string'    => ['stringText'],
        ];
    }

    /**
     * @test
     * @dataProvider providerInvalidIngredientId
     * */
    public function testCantUpdateIngredient(string $ingredientId)
    {
        $user = User::factory()->create();

        $user          = User::factory()->create();
        $newIngredient = [
            "name"  => "Este es el nombre",
            "email" => "test@test.cl"
        ];
        $this->actingAs($user)
            ->putJson('api/ingredients/' . $ingredientId, $newIngredient)
            ->assertNotFound();
    }
}
