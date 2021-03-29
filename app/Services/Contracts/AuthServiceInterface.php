<?php

namespace App\Services\Contracts;

use App\Models\User;

interface AuthServiceInterface
{
    /**
     * @param array $attributes
     * @return User
     */
    public function register(array $attributes): User;

    /**
     * @param array $attributes
     * @return array
     */
    public function login(array $attributes): array;
}
