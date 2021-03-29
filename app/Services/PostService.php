<?php

namespace App\Services;

use App\Models\Post;

use App\Models\User;
use App\Services\Contracts\PostServiceInterface;
//use Illuminate\Pagination\LengthAwarePaginator;
//use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class PostService implements PostServiceInterface
{
    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function list(User $user): LengthAwarePaginator
    {
        return Post::where('user_id', $user->id)
            ->paginate(config('constants.app.pagination_size'));
    }

    /**
     * @param User $user
     * @param array $attributes
     * @return Post
     */
    public function store(User $user, array $attributes): Post
    {
        return $user->posts()->create(
            $attributes
        );
    }

    /**
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post
    {
        return Post::findOrFail($id);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return Post
     */
    public function update(int $id, array $attributes): Post
    {
        $post = $this->find($id);

        $post->update($attributes);

        return $post->refresh();
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $post = $this->find($id);

        $post->delete();
    }
}
