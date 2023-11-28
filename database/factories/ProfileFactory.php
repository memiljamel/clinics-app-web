<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Enums\MartialStatus;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'date_of_birth' => fake()->date(),
            'address' => fake()->address(),
            'status' => fake()->randomElement(MartialStatus::class),
            'gender' => fake()->randomElement(Gender::class),
        ];
    }
}
