<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>  User::inRandomOrder()->first()?->id,
            'phone' => $this->faker->phoneNumber(),
            'bio' => $this->faker->paragraph(),
            'nationality' => $this->faker->country(),
            'experience_years' => $this->faker->numberBetween(2, 10),
            'experience_card' => "def.png",
            'ssn' => $this->faker->randomNumber(9, 14),
            'is_active' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
