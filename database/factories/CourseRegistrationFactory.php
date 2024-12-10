<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' =>  Student::inRandomOrder()->first()?->id ?? Student::factory(),
            'course_id' =>  Course::inRandomOrder()->first()?->id ?? Course::factory(),
            'progress_percentage' => $this->faker->numberBetween(0, 100),
            'registration_date' => now(),
            'expired_date' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
