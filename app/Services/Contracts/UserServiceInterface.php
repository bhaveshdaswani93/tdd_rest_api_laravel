<?php

namespace App\Services\Contracts;

use App\Models\User;

interface UserServiceInterface
{
    public function changePassword(User $user, string $newPassword): void;
}
