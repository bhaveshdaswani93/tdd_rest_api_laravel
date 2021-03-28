<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    /**
     * Undocumented variable
     *
     * @var UserServiceInterface
     */
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(UserServiceInterface::class);
    }



    /** @test */
    public function it_can_change_user_password()
    {
        // Test

        $user = User::factory()->create();

        $newPassword = $this->faker->password;

        $this->service->changePassword($user, $newPassword);

        $user->refresh();

        $this->assertTrue(Hash::check($newPassword, $user->password));
    }

    /** @test */
    public function it_can_update_user_details()
    {
        $user = User::factory()->create();

        $attributes = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail
        ];

        $this->service->update($user, $attributes);

        $attributes['id'] = $user->id;

        $this->assertDatabaseHas('users', $attributes);
    }
}
