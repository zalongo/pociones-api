<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientCreateTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function testCanCreate()
    {
        $user      = User::factory()->create();
        $newClient = [
            "name"  => "Guacolda",
            "email" => "guacolda@test.cl"
        ];


        $clientSpected = [
            "id"    => 1,
            "name"  => "Guacolda",
            "email" => "guacolda@test.cl"
        ];

        $this->actingAs($user)
            ->postJson('api/clients', $newClient)
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data'    => [
                    'id',
                    'name',
                    'email'
                ]
            ])->assertJsonFragment([
                "data" => $clientSpected,
            ]);
    }

    /** @test */
    public function testCantCreateWhenNotLogged()
    {
        $this->postJson('api/clients', [])->assertUnauthorized();
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
        $user = User::factory()->create();
        $this->actingAs($user)
            ->postJson('api/clients', $newClientData)
            ->assertUnprocessable()
            ->assertExactJson([
                'status'  => 'Error',
                'message' => 'Datos no Válidos',
                'data'    => $message
            ]);
    }
}
