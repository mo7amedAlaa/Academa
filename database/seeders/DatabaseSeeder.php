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

        Instructor::factory(30)->create();
        Student::factory(50)->create();
        Course::factory(300)->create();
        // Lesson::factory(4000)->create();
        Review::factory(200)->create();
    }
}
