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

class SaleListTest extends TestCase
{

    use RefreshDatabase;

    public function addPotions($sale, $quantityPotions)
    {
        $saleTotal = 0;
        for ($i = 0; $i < $quantityPotions; $i++) {
            $potion      = Potion::factory()->create();
            $ingredients = Ingredient::factory(rand(2, 20))->create();
            $quantity    = rand(1, 50) / 10;
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
            $saleTotal = $saleTotal + $total;
        }
        return $saleTotal;
    }

    /** @test */
    public function testCanList()
    {
        $user  = User::factory()->create();
        $sales = Sale::factory(9)->create();
        foreach ($sales as $sale) {
            $total       = $this->addPotions($sale, rand(1, 50));
            $sale->total = $total;
            $sale->save();
        }

        $this->actingAs($user)
            ->getJson('api/sales')
            ->assertOk()
            ->assertJsonCount(9, 'data');
    }


    /** @test */
    public function testCantListWhenNotLogged()
    {
        $this->getJson('api/sales')->assertUnauthorized();
    }




    /** @test */
    public function testFilteringByClient()
    {
        $user    = User::factory()->create();
        $clients = Client::factory(3)->create();
        // sales client 1
        Sale::factory(9)->create([
            'client_id' => $clients[0]->id
        ]);
        // sales client 2
        Sale::factory(2)->create([
            'client_id' => $clients[1]->id
        ]);
        $this->actingAs($user)
            ->getJson(sprintf('api/sales?client=%s',  $clients[0]->id))
            ->assertOk()
            ->assertJsonCount(9, 'data');
    }


    /** @test */
    public function testFilteringByClientWithoutSales()
    {
        $user    = User::factory()->create();
        $clients = Client::factory(2)->create();
        $sales   = Sale::factory(9)->create([
            'client_id' => $clients[0]->id
        ]);
        $this->actingAs($user)
            ->getJson(sprintf('api/sales?client=%s',  $clients[1]->id))
            ->assertOk()
            ->assertJsonCount(0, 'data');
    }


    /**
     * @dataProvider providerInalidClient
     */
    public function testInvalidClient(string $client_id)
    {
        $user    = User::factory()->create();
        $clients = Client::factory(2)->create();
        $sales   = Sale::factory(9)->create([
            'client_id' => $clients[0]->id
        ]);

        $this->actingAs($user)
            ->getJson(sprintf('api/sales?client=%s', $client_id))
            ->assertUnprocessable();
    }


    public function providerInalidClient()
    {
        return [
            'Limit with string' => ['unString'],
            'Limit less than 0' => ['-1']
        ];
    }



    /**
     * @dataProvider providerValidLimits
     */
    public function testLimit(int $salesCreated, string $limit)
    {
        $user  = User::factory()->create();
        $sales = Sale::factory($salesCreated)->create();

        $this->actingAs($user)
            ->getJson(sprintf('api/sales?limit=%s', $limit))
            ->assertOk()
            ->assertJsonCount($limit, 'data');
    }


    public function providerValidLimits()
    {
        return [
            'Limit 12' => [29, '12'],
            'Limit 6'  => [29, '6']
        ];
    }

    /**
     * @dataProvider providerInalidLimits
     */
    public function testInvalidLimit(int $salesCreated, string $limit)
    {
        $user  = User::factory()->create();
        $sales = Sale::factory($salesCreated)->create();

        $this->actingAs($user)
            ->getJson(sprintf('api/sales?limit=%s', $limit))
            ->assertUnprocessable();
    }


    public function providerInalidLimits()
    {
        return [
            'Limit with string'  => [29, 'unString'],
            'Limit more than 20' => [50, '50'],
            'Limit less than 0'  => [50, '-1']
        ];
    }


    /**
     * @test
     * @dataProvider providerValidPagination
     *  */
    public function testPagination(int $salesCreated, string $limit, string $page, int $assertCount)
    {
        $user  = User::factory()->create();
        $sales = Sale::factory($salesCreated)->create();

        $this->actingAs($user)
            ->getJson(sprintf('api/sales?limit=%s&page=%s', $limit, $page))
            ->assertOk()
            ->assertJsonCount($assertCount, 'data');
    }


    public function providerValidPagination()
    {
        return [
            'Pagination last page of 17, 5 by 5'     => [17, '5', '4', 2],
            'Pagination last page of 50, 12 by 12'   => [50, '12', '5', 2],
            'Pagination first page of 17, 5 by 5'    => [17, '5', '1', 5],
            'Pagination Second page of 50, 12 by 12' => [50, '12', '2', 12],
        ];
    }


    /** @test */
    public function testFirstPageDefault()
    {
        $user  = User::factory()->create();
        $sales = Sale::factory(7)->create();

        $this->actingAs($user)
            ->getJson('api/sales?limit=5')
            ->assertOk()
            ->assertJsonCount(5, 'data');
    }


    /** @test */
    public function testPageNotfoundOffset()
    {
        $user  = User::factory()->create();
        $sales = Sale::factory(7)->create();

        $this->actingAs($user)
            ->getJson('api/sales?limit=5&page=50')
            ->assertOk()
            ->assertJsonCount(0, 'data');
    }


    /**
     * @dataProvider providerInalidPagination
     */
    public function testInvalidPagination(string $page)
    {
        $user  = User::factory()->create();
        $sales = Sale::factory(50)->create();

        $this->actingAs($user)
            ->getJson(sprintf('api/sales?limit=12&page=%s', $page))
            ->assertUnprocessable();
    }


    public function providerInalidPagination()
    {
        return [
            'Pagination with string' => ['unString'],
            'Pagination less than 0' => ['-1']
        ];
    }
}
