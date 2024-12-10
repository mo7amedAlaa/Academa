<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Course;

class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory(), // Random existing or new
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory(),   // Random existing or new
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
