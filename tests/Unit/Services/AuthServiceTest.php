<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    /**
     * @var AuthServiceInterface
     */

    protected $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(AuthServiceInterface::class);

        // code
    }

    /** @test */
    public function it_can_register_a_user()
    {
        // Test

        $attributes = [
            'email' =>  $this->faker->unique()->safeEmail,
            'name' => $this->faker->name,
            'password' => $this->faker->password
        ];

        // unset($attributes['user_id']);

        $user = $this->service->register($attributes);
        // $user->attributesToArray()

        $this->assertInstanceOf(User::class, $user);

        $toMatch = $attributes;

        unset($toMatch['password']);

        $this->assertDatabaseHas('users', $toMatch);

        $this->assertEquals(['email' => $user->email, 'name' => $user->name], $toMatch);
    }

    /** @test */
    public function it_hashes_password_while_registering_user()
    {
        // Test

        $attributes = [
            'email' =>  $this->faker->unique()->safeEmail,
            'name' => $this->faker->name,
            'password' => $this->faker->password
        ];

        // unset($attributes['user_id']);

        $user = $this->service->register($attributes);

        $this->assertTrue(Hash::check($attributes['password'], $user->password));
        // $this->assertTrue(
        //     Hash::check(
        //         $attributes['password'],
        //         Hash::make($attributes['password'])
        //     )
        // );
    }

    /** @test */
    public function it_can_check_user_email_and_password()
    {
        $password = 'password';
        $user = User::factory()->create(
            ['password' => Hash::make($password)]
        );

        $attributes = [
            'email' => $user->email,
            'password' => $password
        ];

        $result = $this->service->login($attributes);

        $this->assertCount(3, $result);

        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('result', $result);

        // $this->assertEquals($result['user'], $user);
        $this->assertTrue($user->is($result['user']));
    }
}
