<?php

namespace App\Services\Contracts;

use App\Models\User;

interface UserServiceInterface
{
    /**
     * @param User $user
     * @param string $newPassword
     */
    public function changePassword(User $user, string $newPassword): void;

    /**
     * @param User $user
     * @param array $attributes
     */
    public function update(User $user, array $attributes): void;
}
