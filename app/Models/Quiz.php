<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected $fillable = ['lesson_id', 'title'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function score()
    {
        return $this->hasMany(QuizScore::class);
    }
}
