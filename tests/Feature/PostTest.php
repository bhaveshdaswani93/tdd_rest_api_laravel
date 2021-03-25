<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function a_user_can_create_a_post()
    {
        $this->signIn();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $response = $this->json('post', 'api/posts', $attributes);

        $response->assertCreated();

        $this->assertDatabaseHas('posts', $attributes);

        $response->assertJson(
            function (AssertableJson $json) use ($attributes) {
                $json->where('payload.title', $attributes['title'])
                    ->where('payload.description', $attributes['description'])
                    // ->missing('payload.password')
                    ->has('payload.user_id')
                    ->etc();
            }
        );
    }

    /** @test */
    public function a_post_requires_a_title()
    {
        // Test
        $this->handleExceptions([ValidationException::class]);
        $this->signIn();
        // dump($user);
        $attributes = Post::factory()->raw(['title' => '']);
        // dd($attributes);
        $response = $this->json('post', 'api/posts', $attributes);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('title');
    }

    /** @test */
    public function a_post_requires_a_description()
    {
        // Test
        $this->handleExceptions([ValidationException::class]);
        $this->signIn();
        // dump($user);
        $attributes = Post::factory()->raw(['description' => '']);
        // dd($attributes);
        $response = $this->json('post', 'api/posts', $attributes);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('description');
    }

    /** @test */
    public function guests_cannot_create_post()
    {
        $this->handleExceptions([AuthenticationException::class]);
        $response = $this->json('post', 'api/posts');
        $response->assertUnauthorized();
    }

    /** @test */
    public function a_user_can_edit_its_post()
    {
        // Test
        $user = $this->signIn();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $response =  $this->json('patch', 'api/posts/' . $post->id, $attributes);

        $response->assertStatus(200);

        $this->assertDatabaseHas('posts', $attributes);
    }

    /** @test */
    public function guests_cannot_update_a_project()
    {
        // Test

        $this->handleExceptions([AuthenticationException::class]);

        $post = Post::factory()->create();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $response =  $this->json('patch', 'api/posts/' . $post->id, $attributes);

        $response->assertStatus(401);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_others_post()
    {
        $this->handleExceptions([AuthorizationException::class]);

        $this->signIn();

        $post = Post::factory()->create();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $response =  $this->json('patch', 'api/posts/' . $post->id, $attributes);
        // dump($response->json());
        $response->assertStatus(403);
    }
}
