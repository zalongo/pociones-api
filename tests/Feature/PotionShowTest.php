<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Potion;
use App\Models\Ingredient;
use App\Http\Resources\PotionResource;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PotionShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanViewPotion()
    {
        $user   = User::factory()->create();
        $potion = Potion::factory()->create();

        $ingredients = Ingredient::factory(rand(2, 20))->create();
        $quantity    = rand(1, 50) / 10;
        $price       = 0;
        foreach ($ingredients as $ingredient) {
            $price += $ingredient->price * $quantity;
        }
        $potion->price = round($price);
        $potion->save();
        $potion->ingredients()->attach($ingredients->pluck('id')->toArray(), ['quantity' => $quantity]);

        $resp = $this->actingAs($user)
            ->getJson('api/potions/' . $potion->id)
            ->assertOk()
            ->assertJsonFragment([
                'id'          => $potion->id,
                'name'        => $potion->name,
                'price'       => $potion->price,
                'description' => $potion->description,
            ]);

        $this->assertTrue(count($ingredients) == count($resp->json()['data']['ingredients']));

        foreach ($potion->ingredients()->get() as $key => $ingredient) {
            $thisIngredient = [
                "id"          => $ingredient->id,
                "name"        => $ingredient->name,
                "description" => $ingredient->description,
                "quantity"    => $ingredient->pivot->quantity
            ];

            $this->assertTrue($thisIngredient == $resp->json()['data']['ingredients'][$key]);
        }
    }

    public function providerInvalidIds()
    {
        return [
            'Potion id negative'  => ['-1'],
            'Potion id zero'      => ['0'],
            'Potion id non exist' => ['5000000'],
            'Potion id string'    => ['stringText'],
        ];
    }

    /**
     * @test
     * @dataProvider providerInvalidIds
     * */
    public function testCantView(string $potionId)
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->getJson('api/potions/' . $potionId)
            ->assertNotFound();
    }

    /** @test */
    public function testCantViewWhenIsNotLogged()
    {
        $potion = Potion::factory()->create();

        $this->getJson('api/potions/' . $potion->id)
            ->assertUnauthorized();
    }
}
