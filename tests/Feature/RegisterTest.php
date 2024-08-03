<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'qwerty123456!',
            'password_confirmation' => 'qwerty123456!',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'User registered successfully',
            ])
            ->assertJsonStructure([
                'token'
            ]);
    }

    /** @test */
    public function test_user_cannot_register_with_missing_fields()
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email', 'password']);
    }

    /** @test */
    public function test_user_cannot_register_with_mismatched_password_confirmation()
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'qwerty123456!',
            'password_confirmation' => 'different_password',
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'The password confirmation field must match password.',
                 ]);
    }

    /** @test */
    public function test_user_cannot_register_with_existing_email()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'qwerty123456!',
        ]);

        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'qwerty123456!!!',
            'password_confirmation' => 'qwerty123456!!!',
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'The email has already been taken.',
                 ]);
    }
}
