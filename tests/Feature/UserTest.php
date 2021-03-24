<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserTest extends TestCase
{




    /** @test */
    public function a_user_can_change_his_password()
    {
        $user = $this->signIn();
        $newPassword = $this->faker->password;

        $response = $this->json(
            'patch',
            'api/users/change-password',
            ['password' => $newPassword]
        );

        $response->assertOk();
        $this->assertTrue(Hash::check($newPassword, $user->refresh()->password));
    }

    /** @test */
    public function guests_cannot_change_password()
    {
        $this->handleExceptions([AuthenticationException::class]);

        $newPassword = $this->faker->password;

        $response = $this->json(
            'patch',
            'api/users/change-password',
            ['password' => $newPassword]
        );

        $response->assertUnauthorized();
    }

    /** @test */
    public function a_change_password_requires_password()
    {
        $this->handleExceptions([ValidationException::class]);
        $this->signIn();
        // $newPassword = $this->faker->password;

        $response = $this->json(
            'patch',
            'api/users/change-password'

        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function a_user_can_update_his_profile()
    {
        $user = $this->signIn();

        $attributes = [
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->name
        ];

        $response = $this->json('patch', 'api/users/profile', $attributes);

        $response->assertStatus(200);

        $user = $user->refresh();

        $this->assertEquals($attributes['email'], $user->email);
        $this->assertEquals($attributes['name'], $user->name);
    }

    /** @test */
    public function a_guests_cannot_update_profile()
    {
        $this->handleExceptions([AuthenticationException::class]);

        $attributes = [
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->name
        ];

        $response = $this->json('patch', 'api/users/profile', $attributes);

        $response->assertUnauthorized();
    }

    /** @test */
    public function a_user_can_update_only_unique_email()
    {
        $this->handleExceptions([ValidationException::class]);

        $otherUser = User::factory()->create();

        $user = $this->signIn();

        $attributes = [
            'email' => $otherUser->email,
            'name' => $this->faker->name
        ];

        $response = $this->json('patch', 'api/users/profile', $attributes);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }
}
