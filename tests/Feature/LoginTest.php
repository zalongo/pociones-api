<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function testUserCanLoginWithEmailAndPassword()
    {
        $user           = User::factory()->create();
        $user->password = Hash::make(123456);
        $user->save();

        $this->postJson(route('auth.login'), [
            'email'    => $user->email,
            'password' => '123456'
        ])
            ->assertOk()
            ->assertJsonFragment([
                'status' => 'Success',
            ]);
    }

    /** @test */
    public function testLoginReturnAToken()
    {
        $user           = User::factory()->create();
        $user->password = Hash::make(123456);
        $user->save();

        $this->postJson(route('auth.login'), [
            'email'    => $user->email,
            'password' => '123456'
        ])
            ->assertOk()

            ->assertJsonStructure([
                'data' => ['token']
            ]);
    }


    /** @test */
    public function testUserCantLoginWithEmailIncorrectAndPasswordOk()
    {
        $user           = User::factory()->create();
        $user->password = Hash::make(123456);
        $user->save();

        $this->postJson(route('auth.login'), [
            'email'    => 'estenoeselmail@test.cl',
            'password' => '123456'
        ])
            ->assertUnauthorized();
    }

    /** @test */
    public function testUserCantLoginWithEmailOkAndPasswordIncorrect()
    {
        $user = User::factory()->create();

        $this->postJson(route('auth.login'), [
            'email'    => $user->email,
            'password' => 'esta no es la pass'
        ])
            ->assertUnauthorized();
    }

    /** @test */
    public function testEmailAndPasswordAreRequired()
    {
        $this->postJson(route('auth.login'))
            ->assertUnprocessable()
            ->assertExactJson([
                "message" => "The given data was invalid.",
                'errors'  => [
                    "email" => [
                        "El campo email es obligatorio."
                    ],
                    "password" => [
                        "El campo password es obligatorio."
                    ]
                ]
            ]);
    }
}
