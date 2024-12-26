<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizScore extends Model
{
    //
    protected $table = 'quiz_score';
    protected $fillable = ['user_id', 'quiz_id', 'score'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
