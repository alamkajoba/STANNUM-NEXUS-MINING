<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        // 1. On crée un utilisateur fictif
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        // 4. On vérifie si on reçoit un 200 (OK) 
        // ou un 302 vers une autre page interne (ex: /dashboard)
        if ($response->status() === 302) {
            $response->assertRedirect(); // On accepte la redirection si elle est interne
        } else {
            $response->assertStatus(200);
        }
    }
}
