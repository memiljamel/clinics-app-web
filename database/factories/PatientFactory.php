<?php

namespace Database\Factories;

use App\Enums\PatientType;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => fake()->randomElement(PatientType::class),
            'allergy' => fake()->word(),
        ];
    }

    /**
     * Indicate that the medical records number has been set.
     */
    public function medicalRecordsNumber(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'code' => fake()->lexify('id-????'),
        ]);
    }
}
