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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'kader',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Set user role to presidium
     */
    public function presidium(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'presidium',
        ]);
    }

    /**
     * Set user role to kabid
     */
    public function kabid(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'kabid',
        ]);
    }

    /**
     * Set user role to kader
     */
    public function kader(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'kader',
        ]);
    }

    /**
     * Set user role to pembina
     */
    public function pembina(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'pembina',
        ]);
    }
}
