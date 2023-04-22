<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientUpdateTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function testCanUpdateAClient()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();

        $newEmail = 'test@test.cl';

        $clientNewData = [
            'name'  => $client->name,
            'email' => $newEmail
        ];
        $response = $this->actingAs($user)
            ->putJson('api/clients/' . $client->id, $clientNewData)
            ->assertStatus(201);
    }

    /** @test */
    public function testCanEditEmail()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();

        $newEmail = 'test@test.cl';

        $clientNewData = [
            'name'  => $client->name,
            'email' => $newEmail
        ];
        $response = $this->actingAs($user)
            ->putJson('api/clients/' . $client->id, $clientNewData)
            ->assertStatus(201);

        $resposeData = $response->json()['data'];

        $this->assertTrue($client->email !== $resposeData['email']);

        $clientUpdated = Client::find($client->id);
        $this->assertTrue($clientUpdated->email === $newEmail);
    }

    /** @test */
    public function testCanEditName()
    {
        $user   = User::factory()->create();
        $client = Client::factory()->create();

        $newName = 'Nuevo Nombre';

        $clientNewData = [
            'name'  => $newName,
            'email' => $client->email
        ];
        $response = $this->actingAs($user)
            ->putJson('api/clients/' . $client->id, $clientNewData)
            ->assertStatus(201);

        $resposeData = $response->json()['data'];

        $this->assertTrue($client->name !== $resposeData['name']);

        $clientUpdated = Client::find($client->id);
        $this->assertTrue($clientUpdated->name == $newName);
    }

    /** @test */
    public function testCantUpdateWhenIsNotLogged()
    {
        $client = Client::factory()->create();

        $clientNewData = [];
        $this->putJson('api/clients/' . $client->id, $clientNewData)
            ->assertUnauthorized();
    }


    public function validationProvider()
    {
        return [
            'Name is required' => [
                'newClientData' => [
                    "name"  => "",
                    "email" => "jperez@test.cl"
                ],
                'message'       => [
                    'name' => ['El campo name es obligatorio.']
                ]
            ],
            'Email is required' => [
                'newClientData' => [
                    "name"  => "Juan Perez",
                    "email" => ""
                ],
                'message'       => [
                    'email' => ['El campo email es obligatorio.']
                ]
            ],
            'Name min 4 caracteres' => [
                'newClientData' => [
                    "name"  => "Jua",
                    "email" => "jperez@test.cl"
                ],
                'message'       => [
                    'name' => ['El campo name debe contener al menos 4 caracteres.']
                ]
            ],
            'Name max 100 caracteres' => [
                'newClientData' => [
                    "name"  => "aaaa aaaaaa aaaaaaaaaaaaaaaaa aaaaaaaaaaaaa aaaaabbbbbbbbbbbb bbbbbbbbbbbbbbbbbbbb bbbbbbbbbbbbbbbbbbbbbb",
                    "email" => "jperez@test.cl"
                ],
                'message'       => [
                    'name' => ['El campo name no debe contener más de 100 caracteres.']
                ]
            ],
            'Invalid email' => [
                'newClientData' => [
                    "name"  => "Juan Perez",
                    "email" => "isNotAMail"
                ],
                'message'       => [
                    'email' => ['El campo email debe ser una dirección de correo válida.']
                ]
            ],
        ];
    }

    /**
     * @test
     * @dataProvider validationProvider
     * */
    public function testValidation(
        array $newClientData,
        array $message
    ) {
        $client = Client::factory()->create();
        $user   = User::factory()->create();

        $this->actingAs($user)->putJson('api/clients/' . $client->id, $newClientData)
            ->assertUnprocessable()
            ->assertExactJson([
                'status'  => 'Error',
                'message' => 'Datos no Válidos',
                'data'    => $message
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
    public function testCantUpdateClient(string $clientId)
    {
        $user = User::factory()->create();

        $user      = User::factory()->create();
        $newClient = [
            "name"  => "Este es el nombre",
            "email" => "test@test.cl"
        ];
        $this->actingAs($user)
            ->putJson('api/clients/' . $clientId, $newClient)
            ->assertNotFound();
    }
}
