<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CourseLevel;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $coverImages = [
            'uploads/courses/course_675f7cea3ca0e.jpeg',
            'uploads/courses/cover_image_675f84e2a2eec.jpeg',
            'uploads/courses/course_675f7ca913082.jpeg',
            'uploads/courses/course_675f7c86c0bd5.jpeg',
            'uploads/courses/course_675f7c6504ad0.jpeg',
            'uploads/courses/course_675f7c513dc09.jpeg',
        ];
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 50, 1000),
            'duration_hours' => $this->faker->randomNumber(2),
            'discount' => $this->faker->randomFloat(2, 0, 10),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'max_students' => $this->faker->randomNumber(2, 0),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'isFree' => $this->faker->boolean(),
            'instructor_id' => Instructor::inRandomOrder()->first()?->id,
            'cover_image' => $this->faker->randomElement($coverImages),
            'category_id' => Category::inRandomOrder()->first()?->id,
            'level_id' => CourseLevel::inRandomOrder()->first()?->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
