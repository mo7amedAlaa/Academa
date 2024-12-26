<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    use HasFactory, HasRoles;
    //
    protected $fillable = ['user_id', 'name', 'phone', 'address', 'interests_field'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_registrations', 'student_id', 'course_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
    public function lessonStatus()
    {
        return $this->hasMany(LessonStatus::class);
    }
}
