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
    public function a_user_can_register()
    {
        $attributes = User::factory()->raw(['password' => $this->faker->password]);
        // $attributes = 
        $response = $this->json('post', 'api/register', $attributes);
        $response->assertStatus(200);

        $this->assertDatabaseHas(
            'users',
            [
                'name' => $attributes['name'],
                'email' => $attributes['email'],
            ]
        );
        $response->assertJson(
            function (AssertableJson $json) use ($attributes) {
                $json->where('payload.name', $attributes['name'])
                    ->where('payload.email', $attributes['email'])
                    ->missing('payload.password')
                    ->has('payload.user_id')
                    ->etc();
            }
        );
    }

    /** @test */
    public function a_user_requires_a_name()
    {
        // Test
        $this->handleExceptions([ValidationException::class]);
        $attributes = User::factory()->raw(['name' => '']);
        $response = $this->json('post', 'api/register', $attributes);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function a_user_requires_an_email()
    {
        // Test
        $this->handleExceptions([ValidationException::class]);
        $attributes = User::factory()->raw(['email' => '']);
        $response = $this->json('post', 'api/register', $attributes);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function a_user_requires_an_password()
    {
        // Test
        $this->handleExceptions([ValidationException::class]);
        $attributes = User::factory()->raw(['password' => '']);
        $response = $this->json('post', 'api/register', $attributes);
        // dd($response->json());
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');


        // $this->assertStringContainsString('password', $response['message']);
    }

    /** @test */
    public function a_register_user_should_receive_token()
    {
        $attributes = User::factory()->raw(['password' => $this->faker->password]);
        // $attributes = 
        $response = $this->json('post', 'api/register', $attributes);
        $response->assertStatus(200);
        $response->assertJson(
            function (AssertableJson $json) use ($attributes) {
                $json->has('payload.auth_token')
                    ->etc();
            }
        );
    }

    /** @test */
    public function a_user_can_login()
    {
        // Test
        $password = 'password';
        $passwordHash = Hash::make($password);
        $user = User::factory()->create(['password' => $passwordHash]);

        $response = $this->json(
            'post',
            'api/login',
            ['email' => $user->email, 'password' => $password]
        );
        // dd($response->json());
        $response->assertStatus(200);

        // $response->assertJsonValidationErrors()

        $response->assertJson(
            function (AssertableJson $json) use ($user) {
                $json->where('payload.name', $user->name)
                    ->where('payload.email', $user->email)
                    ->missing('payload.password')
                    ->where('payload.user_id', $user->id)
                    ->etc();
            }
        );
    }

    /** @test */
    public function a_user_login_requires_a_password()
    {
        $this->handleExceptions([ValidationException::class]);
        $user = User::factory()->create();

        $response = $this->json(
            'post',
            'api/login',
            ['email' => $user->email]
        );

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function a_user_login_requires_a_email()
    {
        $this->handleExceptions([ValidationException::class]);
        $user = User::factory()->create();

        $response = $this->json(
            'post',
            'api/login',
            ['password' => 'random-password']
        );

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('email');
    }

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
