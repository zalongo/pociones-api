<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Sale;
use App\Models\User;
use App\Models\Client;
use App\Models\Potion;
use App\Models\Ingredient;
use App\Models\PotionSale;
use App\Http\Resources\SaleResource;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class SaleShowTest extends TestCase
{
    use RefreshDatabase;


    public function addPotions($sale, $quantityPotions)
    {
        $saleTotal = 0;
        $potions   = [];
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
            PotionSale::create([
                'potion_id' => $potion->id,
                'sale_id'   => $sale->id,
                'quantity'  => $quantityThisPotion,
                'total'     => $total,
            ]);

            $potions[] = [
                "id"          => $potion->id,
                "name"        => $potion->name,
                "description" => $potion->description,
                "quantity"    => $quantityThisPotion,
                "total"       => $total
            ];

            $saleTotal = $saleTotal + $total;
        }
        return [$saleTotal, $potions];
    }

    /** @test */
    public function testCanViewSale()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();
        $sale   = Sale::factory()->create([
            'client_id' => $client->id
        ]);

        $quantityPotions   = rand(1, 50);
        [$total, $potions] = $this->addPotions($sale, $quantityPotions);
        $sale->total       = $total;
        $sale->save();

        $this->actingAs($user)
            ->getJson('api/sales/' . $sale->id)
            ->assertOk()
            ->assertJsonFragment([
                'id'        => $sale->id,
                'total'     => $sale->total,
                'client_id' => $sale->client_id,
                "client"    => [
                    "id"    => $client->id,
                    "name"  => $client->name,
                    "email" => $client->email,
                ],
                "potions" => $potions
            ]);
    }

    public function providerInvalidIds()
    {
        return [
            'Sale id negative'  => ['-1'],
            'Sale id zero'      => ['0'],
            'Sale id non exist' => ['5000000'],
            'Sale id string'    => ['stringText'],
        ];
    }

    /**
     * @test
     * @dataProvider providerInvalidIds
     * */
    public function testCantView(string $saleId)
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->getJson('api/sales/' . $saleId)
            ->assertNotFound();
    }

    /** @test */
    public function testCantViewWhenIsNotLogged()
    {
        $sale = Sale::factory()->create();

        $this->getJson('api/sales/' . $sale->id)
            ->assertUnauthorized();
    }
}
