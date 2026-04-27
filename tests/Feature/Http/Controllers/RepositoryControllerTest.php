<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Repository;

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


    public function test_index_empty(): void
    {
        Repository::factory()->create(); // user_id 1

        $user = User::factory()->create(); // id 2

        // $this->withoutExceptionHandling();

        $this
            ->actingAs($user)
            ->get('repositories')
            ->assertStatus(200)
            ->assertSeeText('No hay repositorios creados');
    }

    public function test_index_with_data(): void
    {
        $user = User::factory()->create(); // id 1
        $repository = Repository::factory()->create(['user_id' => $user->id]); // user_id 1

        $this
            ->actingAs($user)
            ->get('repositories')
            ->assertStatus(200)
            ->assertSeeText($repository->id)
            ->assertSeeText($repository->url);
    }

    public function test_show(): void
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);
        
        // $this->withoutExceptionHandling();
        $this
            ->actingAs($user)
            ->get("repositories/$repository->id")
            ->assertStatus(200)
            ->assertSee($repository->id)
            ->assertSee($repository->url);
    }

    public function test_show_policy(): void
    {
        $user = User::factory()->create(); // id = 1
        $repository = Repository::factory()->create(); // user_id = 2

        $this
            ->actingAs($user)
            ->get("repositories/$repository->id")
            ->assertStatus(403);
    }

    public function test_edit(): void
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);
        
        // $this->withoutExceptionHandling();
        $this
            ->actingAs($user)
            ->get("repositories/$repository->id/edit")
            ->assertStatus(200)
            ->assertSee($repository->url)
            ->assertSee($repository->description);
    }

    public function test_edit_policy(): void
    {
        $user = User::factory()->create(); // id = 1
        $repository = Repository::factory()->create(); // user_id = 2

        $this
            ->actingAs($user)
            ->get("repositories/$repository->id/edit")
            ->assertStatus(403);
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

        $this->assertDatabaseHas('repositories', $data);
    }

    public function test_update(): void
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $data = [
            'url'           => $this->faker->url,
            'description'   => $this->faker->text,
        ];


        // $this->withoutExceptionHandling();
        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertRedirect("repositories/$repository->id/edit");


        $this->assertDatabaseHas("repositories", $data);
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);


        $this
            ->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertRedirect("repositories");


        $this->assertDatabaseMissing("repositories", [
            'id'            => $repository->id,
            'url'           => $repository->url,
            'description'   => $repository->description,
        ]);
    }

    public function test_validate_store(): void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('repositories', [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['url', 'description']);
    }

    public function test_validate_update(): void
    {
        $repository = Repository::factory()->create();

        $user = User::factory()->create();

        // $this->withoutExceptionHandling();
        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['url', 'description']);
    }

    // Policies

    public function test_update_policy(): void
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();
        $data = [
            'url'           => $this->faker->url,
            'description'   => $this->faker->text,
        ];

        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertStatus(403);
    }

    public function test_destroy_policy(): void
    {
        $user = User::factory()->create();              // user id = 1
        $repository = Repository::factory()->create();  // user_id = 2

        $this
            ->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertStatus(403);
    }
}
