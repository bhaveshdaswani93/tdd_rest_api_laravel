<?php

namespace Tests\Unit\Services;

use App\Models\Post;
use App\Models\User;
use App\Services\Contracts\PostServiceInterface;
// use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class PostServiceTest extends TestCase
{

    protected $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(PostServiceInterface::class);

        // code
    }

    /** @test  */
    public function it_can_paginate_user_posts()
    {
        $user = User::factory()->create();

        $pageSize = config('constants.app.pagination_size');

        $additional = 1;

        $total = $pageSize + $additional;

        Post::factory()->count($total)->create(['user_id' => $user->id]);

        Post::factory()->count(5)->create();

        $posts = $this->service->list($user);

        $this->assertInstanceOf(LengthAwarePaginator::class, $posts);

        // dd($posts);
        // dump($posts->items());
        // dump($posts->items());
        // dump($posts->items());

        $this->assertCount($pageSize, $posts->items());
        $this->assertEquals($total, $posts->total());
        $this->assertEquals($pageSize, $posts->perPage());
        $this->assertEquals(ceil($total / $pageSize), $posts->lastPage());
    }

    /** @test */
    public function it_can_store_post()
    {
        // Test

        $user = User::factory()->create();

        $attributes = Post::factory()->raw();

        unset($attributes['user_id']);

        $post = $this->service->store($user, $attributes);

        $this->assertInstanceOf(Post::class, $post);

        $attributes['user_id'] = $user->id;

        $this->assertDatabaseHas('posts', $attributes);
    }

    /** @test */
    public function it_can_find_existing_post()
    {
        // Test

        $post = Post::factory()->create();

        $searchedPost = $this->service->find($post->id);

        $this->assertInstanceOf(Post::class, $searchedPost);

        $this->assertTrue($post->is($searchedPost));
    }

    /** @test */
    public function it_can_through_exception_for_finding_missing_post()
    {
        // Test

        $this->expectException(ModelNotFoundException::class);

        $this->service->find(1);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        // Test

        $post = Post::factory()->create();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $updatedPost = $this->service->update($post->id, $attributes);

        $this->assertInstanceOf(Post::class, $updatedPost);

        // $post->refresh();

        $this->assertTrue($post->is($updatedPost));

        $attributes['id'] = $post->id;

        $this->assertDatabaseHas('posts', $attributes);
    }

    /** @test */
    public function it_can_soft_delete_a_post()
    {
        // Test

        $post = Post::factory()->create();

        $this->service->delete($post->id);

        $this->assertSoftDeleted('posts', ['id' => $post->id]);
    }
}
