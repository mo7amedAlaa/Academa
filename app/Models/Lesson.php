<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    //
    protected $fillable = ['course_id', 'title', 'content_type', 'content', 'instructor_id', 'media', 'link', 'position', 'is_public', 'notes'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function status()
    {
        return $this->hasMany(LessonStatus::class);
    }
    public function quiz()
    {

        return $this->hasOne(Quiz::class);
    }
}
