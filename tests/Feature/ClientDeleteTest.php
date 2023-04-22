<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanDeleteClient()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();

        $this->actingAs($user)->deleteJson('api/clients/' . $client->id)->assertStatus(202);

        $this->actingAs($user)->getJson('api/clients/' . $client->id)->assertNotFound();
    }


    /** @test */
    public function testCantViewClientWhenIsNotLogged()
    {
        $client = Client::factory()->create();

        $this->deleteJson('api/clients/' . $client->id)->assertUnauthorized();
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
    public function testCantDeleteClient(string $clientId)
    {
        $user = User::factory()->create();
        $this->actingAs($user)->deleteJson('api/clients/' . $clientId)->assertNotFound();
    }
}
