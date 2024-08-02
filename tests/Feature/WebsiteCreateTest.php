<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_a_website()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/websites', [
            'name' => 'Test Website',
            'url' => 'http://testwebsite.com',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('websites', [
            'name' => 'Test Website',
        ]);
    }

    /** @test */
    public function unauthenticated_user_cannot_create_a_website()
    {
        $response = $this->post('/websites', [
            'name' => 'Test Website',
            'url' => 'http://testwebsite.com',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
    }
}
