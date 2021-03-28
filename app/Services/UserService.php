<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function changePassword(User $user, string $newPassword): void
    {
        $user->update(
            [
                'password' => Hash::make($newPassword)
            ]
        );
    }
}
