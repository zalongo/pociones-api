<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanViewIngredient()
    {
        $user       = User::factory()->create();
        $ingredient = Ingredient::factory()->create();

        $this->actingAs($user)
            ->getJson('api/ingredients/' . $ingredient->id)
            ->assertOk()
            ->assertJsonFragment([
                'id'          => $ingredient->id,
                'name'        => $ingredient->name,
                'description' => $ingredient->description,
                'price'       => $ingredient->price,
                'stock'       => $ingredient->stock,
            ]);
    }

    public function providerInvalidIds()
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
     * @dataProvider providerInvalidIds
     * */
    public function testCantView(string $ingredientId)
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->getJson('api/ingredients/' . $ingredientId)
            ->assertNotFound();
    }

    /** @test */
    public function testCantViewWhenIsNotLogged()
    {
        $ingredient = Ingredient::factory()->create();

        $this->getJson('api/ingredients/' . $ingredient->id)
            ->assertUnauthorized();
    }
}
