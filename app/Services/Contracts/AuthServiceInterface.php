<?php

namespace App\Services\Contracts;

use App\Models\User;

interface AuthServiceInterface
{
    public function register(array $attributes): User;

    public function login(array $attributes): array;
}
