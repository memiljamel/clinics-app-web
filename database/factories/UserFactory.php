<?php

namespace Database\Factories;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
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
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => fake()->e164PhoneNumber(),
            'photo' => UploadedFile::fake()->image('photo.png')->hashName(),
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
     * Indicate that the user is administrator.
     */
    public function administrator(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => Role::Administrator->value,
            ];
        });
    }

    /**
     * Indicate that the user is patient.
     */
    public function patient(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => Role::Patient->value,
            ];
        });
    }
}
