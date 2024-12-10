<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    //
    protected $fillable = ['user_id', 'course_id', 'instructor_id', 'rating', 'comment'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
