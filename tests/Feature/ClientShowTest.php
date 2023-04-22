<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanViewClient()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();

        $this->actingAs($user)
            ->getJson('api/clients/' . $client->id)
            ->assertOk()
            ->assertJsonFragment([
                'id'    => $client->id,
                "email" => $client->email,
                "name"  => $client->name
            ]);
    }

    public function providerInvalidClientId()
    {
        return [
            'Client id negative'  => ['-1'],
            'Client id zero'      => ['0'],
            'Client id non exist' => ['5000000'],
            'Client id string'    => ['stringText'],
        ];
    }

    /**
     * @test
     * @dataProvider providerInvalidClientId
     * */
    public function testCantViewClient(string $clientId)
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->getJson('api/clients/' . $clientId)
            ->assertNotFound();
    }

    /** @test */
    public function testCantViewClientWhenIsNotLogged()
    {
        $client = Client::factory()->create();

        $this->getJson('api/clients/' . $client->id)
            ->assertUnauthorized();
    }
}
