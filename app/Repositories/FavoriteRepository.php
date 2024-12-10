<?php

namespace App\Repositories;

use App\Models\Favorite;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class FavoriteRepository
{
    /**
     * Add a course to the student's favorites.
     *
     * @param int $studentId
     * @param int $courseId
     * @return bool
     */
    public function addFavorite(int $studentId, int $courseId): bool
    {
        $exists = Favorite::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->exists();

        if (!$exists) {
            Favorite::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
            ]);
            return true;
        }

        return false;
    }

    /**
     * Remove a course from the student's favorites.
     *
     * @param int $studentId
     * @param int $courseId
     * @return bool
     */
    public function removeFavorite(int $studentId, int $courseId): bool
    {
        $favorite = Favorite::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return true;
        }

        return false;
    }

    /**
     * Get all favorite courses for a student.
     *
     * @param int $studentId
     * @return Collection
     */
    public function getFavorites(int $studentId): Collection
    {
        $student = Student::find($studentId);

        return $student ? $student->favorites->map->course : collect();
    }
}
