<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $response->assertStatus(400);
        $this->assertStringContainsString('name', $response['message']);
    }

    /** @test */
    public function a_user_requires_an_email()
    {
        // Test
        $this->handleExceptions([ValidationException::class]);
        $attributes = User::factory()->raw(['email' => '']);
        $response = $this->json('post', 'api/register', $attributes);
        $response->assertStatus(400);
        $this->assertStringContainsString('email', $response['message']);
    }

    /** @test */
    public function a_user_requires_an_password()
    {
        // Test
        $this->handleExceptions([ValidationException::class]);
        $attributes = User::factory()->raw(['password' => '']);
        $response = $this->json('post', 'api/register', $attributes);
        $response->assertStatus(400);
        $this->assertStringContainsString('password', $response['message']);
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
}
