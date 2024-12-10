<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseLevel;
use App\Models\Favorite;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Instructor::factory(10)->create();
        // CourseLevel::factory(5)->create();
        // Category::factory(10)->create();

        Course::factory(100)->create();
        Student::factory(5)->create();
        Lesson::factory(100)->create();
        Review::factory(100)->create();
        Payment::factory(5)->create();
        Certificate::factory(3)->create();
        // Favorite::factory(5)->create();
    }
}
