<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserInfoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanGetInfoWhenIsLogged()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->getJson(route('user.data'))
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'id'    => $user->id,
                    "email" => $user->email,
                    "name"  => $user->name
                ]
            ]);
    }


    /** @test */
    public function testCantGetInfoWhenIsNotLogged()
    {
        $this->getJson(route('user.data'))
            ->assertUnauthorized();
    }
}
