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

    /** @test */
    public function a_user_can_view_their_post()
    {
        $user = $this->signIn();

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->json('get', 'api/posts/' . $post->id);

        $response->assertOk();

        $response->assertJson(
            function (AssertableJson $json) use ($post) {
                $json->where('payload.title', $post->title)
                    ->where('payload.description', $post->description)
                    ->where('payload.post_id', $post->id)
                    // ->missing('payload.password')
                    ->has('payload.user_id')
                    ->etc();
            }
        );
    }

    /** @test */
    public function guests_cannot_view_project()
    {
        $this->handleExceptions([AuthenticationException::class]);

        $post = Post::factory()->create();

        $response = $this->json('get', 'api/posts/' . $post->id);

        $response->assertUnauthorized();
    }

    /** @test */
    public function an_authenticated_user_cannot_view_others_post()
    {
        // Test
        $this->handleExceptions([AuthorizationException::class]);

        $user = $this->signIn();

        $post = Post::factory()->create();

        $response = $this->json('get', 'api/posts/' . $post->id);

        $response->assertForbidden();
    }

    /** @test */
    public function a_user_can_delete_its_post()
    {
        // Test

        $user = $this->signIn();

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->json('delete', 'api/posts/' . $post->id);

        $response->assertNoContent();

        // dd($post->id);

        // $this->assertDatabaseMissing(
        //     'posts',
        //     [
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'description' => $post->description
        //     ]
        // );

        $this->assertSoftDeleted(
            'posts',
            [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description
            ]
        );

        //         // Check that the user has been soft deleted
        // $this->assertSoftDeleted('users', [
        //     'id' => $deletedUser->id,
        //     'name' => $deletedUser->name,
        //     'email' => $deletedUser->email,
        // ]);
    }

    /** @test */
    public function guests_cannot_delete_a_post()
    {
        $this->handleExceptions([AuthenticationException::class]);

        $post = Post::factory()->create();

        $response = $this->json('delete', 'api/posts/' . $post->id);

        $response->assertUnauthorized();
    }

    /** @test */
    public function an_authenticated_user_cannot_delete_others_post()
    {
        $this->handleExceptions([AuthorizationException::class]);

        $this->signIn();

        $post = Post::factory()->create();

        $response = $this->json('delete', 'api/posts/' . $post->id);

        $response->assertForbidden();
    }

    /** @test */
    public function a_user_can_view_their_all_projects()
    {
        // Test
        $user = $this->signIn();

        $posts = Post::factory()->count(3)->create(['user_id' => $user->id]);

        $otherPosts = Post::factory()->count(3)->create();

        // dd($posts->count());

        $response = $this->json('get', 'api/posts');

        // dd($response['payload']);

        $this->assertCount($posts->count(), $response['payload']);

        // dd(array_column($response['payload'], 'post_id'));

        $posts->map(
            function ($post) use ($response) {
                $this->assertContains($post->id, array_column($response['payload'], 'post_id'));
            }
        );

        // $this->assertNotContains()

        $response->assertJsonStructure(
            [
                'payload' => [
                    '*' => [
                        'post_id',
                        'user_id',
                        'title',
                        'description'
                    ]
                ]
            ]
        );

        /** Check for pagination */

        // $response
        //     ->assertJson(
        //         function (AssertableJson $json) use ($posts) {
        //             // $json->has('meta')
        //             dd($posts->pluck('title', 'id')->all());
        //             dump($json->toArray()['payload']);
        //             $json
        //                 ->has(
        //                     'payload',
        //                     $posts->count()
        //                 );
        //         }
        //     );
    }

    /** @test  */
    public function guests_cannot_view_all_projects()
    {

        $this->withExceptionHandling();

        $response = $this->json('get', 'api/posts');

        $response->assertUnauthorized();
    }

    /** @test */
    public function an_authenticated_user_cannot_view_others_all_posts()
    {
        // Test
        $user = $this->signIn();

        Post::factory()->count(3)->create(['user_id' => $user->id]);

        $otherPosts = Post::factory()->count(3)->create();

        // dd($posts->count());

        $response = $this->json('get', 'api/posts');

        $otherPosts->map(
            function ($otherPost) use ($response) {
                $this->assertNotContains($otherPost->id, array_column($response['payload'], 'post_id'));
            }
        );
    }
}
