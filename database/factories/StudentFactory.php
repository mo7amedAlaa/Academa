<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>  User::factory()->create()->id,
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'interests_field' => Category::inRandomOrder()->first()?->id ?? Category::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
