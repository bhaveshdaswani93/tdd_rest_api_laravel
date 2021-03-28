<?php

namespace App\Services\Contracts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostServiceInterface
{
    public function list(User $user): LengthAwarePaginator;
    public function store(User $user, array $attributes): Post;

    /**
     * This will return Post Model
     *
     * @param integer $id This is the Id for which database has to be queried
     * 
     * @return Post
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): Post;

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param array $attributes
     * @return Post
     */
    public function update(int $id, array $attributes): Post;

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void;
}
