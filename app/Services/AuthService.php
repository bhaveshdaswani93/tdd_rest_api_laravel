<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    /**
     * @param array $attributes
     * @return User
     */
    public function register(array $attributes): User
    {
        $attributes['password'] = Hash::make($attributes['password']);

        return User::create(
            $attributes
        );
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function login(array $attributes): array
    {
        $user = User::where('email', $attributes['email'])->first();
        $message = '';
        $result = true;

        if (!$user) {
            $result = false;
            $message = 'User not registered.';
            // return $this->respondBadRequest('User not registered.');
        }

        if (!Hash::check('password', $user->password)) {
            $result = false;
            $message = 'Wrong password provided.';
            // return $this->respondBadRequest('Wrong password provided.');
        }

        return compact('user', 'message', 'result');
    }
}
