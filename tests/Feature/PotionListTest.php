<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Potion;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PotionListTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function testCanList()
    {
        $user = User::factory()->create();

        $potions = Potion::factory(9)->create();
        foreach ($potions as $potion) {
            $ingredients = Ingredient::factory(rand(2, 20))->create();
            $quantity    = rand(1, 50) / 10;
            $potion->ingredients()->attach($ingredients->pluck('id')->toArray(), ['quantity' => $quantity]);
            $price = 0;
            foreach ($ingredients as $ingredient) {
                $price += $ingredient->price * $quantity;
            }
            $potion->price = round($price);
            $potion->save();
        }

        $this->actingAs($user)
            ->getJson('api/potions')
            ->assertOk()
            ->assertJsonCount(9, 'data');
    }


    /** @test */
    public function testCantListWhenNotLogged()
    {
        $this->getJson('api/potions')->assertUnauthorized();
    }

    /**
     * @dataProvider providerValidLimits
     */
    public function testLimit(int $potionsCreated, string $limit)
    {
        $user = User:: factory()->create();
              Potion:: factory($potionsCreated)->create();

        $this->actingAs($user)
            ->getJson(sprintf('api/potions?limit=%s', $limit))
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
    public function testInvalidLimit(int $potionsCreated, string $limit)
    {
        $user = User:: factory()->create();
              Potion:: factory($potionsCreated)->create();

        $this->actingAs($user)
            ->getJson(sprintf('api/potions?limit=%s', $limit))
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
    public function testPagination(int $potionsCreated, string $limit, string $page, int $assertCount)
    {
        $user = User:: factory()->create();
              Potion:: factory($potionsCreated)->create();

        $this->actingAs($user)
            ->getJson(sprintf('api/potions?limit=%s&page=%s', $limit, $page))
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
        $user = User:: factory()->create();
              Potion:: factory(7)->create();

        $this->actingAs($user)
            ->getJson('api/potions?limit=5')
            ->assertOk()
            ->assertJsonCount(5, 'data');
    }


    /** @test */
    public function testPageNotfoundOffset()
    {
        $user = User:: factory()->create();
              Potion:: factory(7)->create();

        $this->actingAs($user)
            ->getJson('api/potions?limit=5&page=50')
            ->assertOk()
            ->assertJsonCount(0, 'data');
    }


    /**
     * @dataProvider providerInalidPagination
     */
    public function testInvalidPagination(string $page)
    {
        $user = User:: factory()->create();
              Potion:: factory(50)->create();

        $this->actingAs($user)
            ->getJson(sprintf('api/potions?limit=12&page=%s', $page))
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
