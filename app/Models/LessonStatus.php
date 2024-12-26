<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonStatus extends Model
{
    //
    protected $table = 'lesson_status';
    protected $fillable = ['student_id', 'course_id', 'lesson_id', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
