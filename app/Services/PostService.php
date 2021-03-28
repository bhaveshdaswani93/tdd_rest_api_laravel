<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class PostService implements PostServiceInterface
{
    public function list(User $user): LengthAwarePaginator
    {
        return Post::whereUserId($user->id)
            ->paginate(config('constants.app.pagination_size'));
    }

    public function store(User $user, array $attributes): Post
    {
        return $user->posts()->create(
            $attributes
        );
    }
    /**
     * This will return Post Model
     *
     * @param integer $id This is the Id for which database has to be queried
     * 
     * @return Post
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): Post
    {
        return Post::findOrFail($id);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
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
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        $post = $this->find($id);

        $post->delete();
    }
}
