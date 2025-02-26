<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'login' => $this->faker->unique()->userName,
            'password' => '123',
            'phone' => $this->faker->phoneNumber,
            'role_id' => 3,
            'remember_token' => Str::random(10),
            'pix' => $this->faker->unique()->safeEmail,
        ];
    }
}
