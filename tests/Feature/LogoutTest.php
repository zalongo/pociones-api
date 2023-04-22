<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanLogout()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('auth.logout'))
            ->assertOk();
    }


    /** @test */
    public function testCantLogoutWhenIsNotLogged()
    {
        $this->postJson(route('auth.logout'))
            ->assertUnauthorized();
    }
}
