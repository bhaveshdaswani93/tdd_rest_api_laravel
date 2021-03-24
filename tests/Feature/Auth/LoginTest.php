<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class LoginTest extends TestCase
{
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
    public function a_user_can_logout()
    {
        $this->handleExceptions([AuthenticationException::class, ValidationException::class]);
        // $user = $this->signIn();
        $user = User::factory()->create();
        $token = $user->createToken('Access Token')->accessToken;
        // $response = $this->json('post','api/login',[])
        $header = ['Authorization' => 'Bearer ' . $token];
        $response = $this->json('post', '/api/logout', [], $header);

        $response->assertOk();
        $this->assertDatabaseHas('oauth_access_tokens', ['user_id' => $user->id, 'revoked' => 1]);
        // $response = $this->json('patch', 'api/users/change-password', ['' => '12346'], ['Authorization' => 'Bearer ']);
        // dd($response->json());

        // $this->assertGuest('api');
    }

    /** @test */
    public function a_guest_cannot_logout()
    {
        $this->handleExceptions([AuthenticationException::class]);

        $response = $this->json('post', 'api/logout');
        $response->assertUnauthorized();
    }
}
