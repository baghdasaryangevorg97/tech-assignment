<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class WebsiteCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_anauthorized_user_website()
    {
        $response = $this->postJson('/api/v1/websites/add', [
            'url' => 'https://laravel.com/docs/11.x/testing',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Unauthenticated.',
                 ]);
    }

    /** @test */
    public function test_user_can_create_website()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('qwerty123456!'),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/v1/websites/add', [
            'url' => 'https://laravel.com/docs/11.x/testing',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'success'
                 ]);
    }
}
