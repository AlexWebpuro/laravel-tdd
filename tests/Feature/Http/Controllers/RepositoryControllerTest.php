<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RepositoryControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_guest(): void
    {
        $this->get('repositories')->assertRedirect('login');        // Index
        $this->get('repositories/create')->assertRedirect('login'); // Create
        $this->get('repositories/1')->assertRedirect('login');      // Read OR Show
        $this->put('repositories/1')->assertRedirect('login');      // Update
        $this->delete('repositories/1')->assertRedirect('login');   // Delete
        $this->get('repositories/1/edit')->assertRedirect('login'); // Edit
        $this->post('repositories', [])->assertRedirect('login');   // Save
    }

    public function test_store(): void
    {
        $data = [
            'url'           => $this->faker->url,
            'description'   => $this->faker->text,
        ];

        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('repositories', $data)
            ->assertRedirect('repositories');

        $this
            ->assertDatabaseHas('repositories', $data);
    }
}
