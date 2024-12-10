<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::inRandomOrder()->first()?->id ?? Course::factory()->create()->id,
            'title' => $this->faker->sentence(),
            'content_type' => $this->faker->randomElement(['video', 'image', 'link', 'quiz', 'practice']),
            'resources' => $this->faker->text(),
            'position' => $this->faker->randomNumber(9, 3),
            'is_public' => $this->faker->boolean(),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
