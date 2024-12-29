<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    //
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'discount', 'start_date', 'max_students', 'duration_hours', 'cover_image', 'isFree', 'status', 'category_id', 'level_id', 'instructor_id'];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function level()
    {
        return $this->belongsTo(CourseLevel::class);
    }


    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'course_registrations',
        );
    }




    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
