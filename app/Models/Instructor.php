<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    //
    protected $fillable = [
        'user_id',
        'phone',
        'bio',
        'nationality',
        'experience_years',
        'experience_card',
        'age',
        'ssn',
        'is_active'
    ];
    protected $casts = [

        'password' => 'hashed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }
}
