<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'avatar' => UploadedFile::fake()->image('avatar.png')->hashName(),
            'name' => fake()->name(),
            'specialists' => fake()->jobTitle(),
            'signature' => UploadedFile::fake()->image('signature.png')->hashName(),
            'is_active' => fake()->boolean(),
        ];
    }
}
