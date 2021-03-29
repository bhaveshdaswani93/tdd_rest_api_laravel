<?php

namespace App\Services\Contracts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

//use Illuminate\Pagination\LengthAwarePaginator;

interface PostServiceInterface
{
    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function list(User $user): LengthAwarePaginator;

    /**
     * @param User $user
     * @param array $attributes
     * @return Post
     */
    public function store(User $user, array $attributes): Post;

    /**
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post;

    /**
     * @param int $id
     * @param array $attributes
     * @return Post
     */
    public function update(int $id, array $attributes): Post;

    /**
     * @param int $id
     */
    public function delete(int $id): void;
}
