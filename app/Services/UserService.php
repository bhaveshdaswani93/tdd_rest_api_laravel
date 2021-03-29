<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    /**
     * @param User $user
     * @param string $newPassword
     */
    public function changePassword(User $user, string $newPassword): void
    {
        $user->update(
            [
                'password' => Hash::make($newPassword)
            ]
        );
    }

    /**
     * @param User $user
     * @param array $attributes
     */
    public function update(User $user, array $attributes): void
    {
        $user->update($attributes);
    }
}
