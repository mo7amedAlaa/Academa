<?php

namespace App\Repositories;

use App\Dto\CourseDto;
use App\Models\Course;
use App\Models\CourseLevel;
use App\Http\Requests\CourseRequest;

class CourseRepository
{

    protected Course  $course;
    protected CourseLevel  $courseLevel;

    public function __construct()
    {
        $this->course = new Course();
        $this->courseLevel = new CourseLevel();
    }
    public function create()
    {
        $levels =  $this->courseLevel->all();
        return $levels;
    }
    public function store(CourseDto $request)
    {
        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->instructor_id = $request->instructor_id;
        $course->duration_hours = $request->duration_hours;
        $course->status = $request->status;
        $course->category_id = $request->category_id;
        $course->isFree = $request->isFree;
        $course->start_date = $request->start_date;
        $course->cover_image = $request->cover_image;
        $course->max_students = $request->max_students;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->level_id = $request->level_id;
        return $course->save();
    }


    public function getAllCourses()
    {
        return $this->course->all();
    }

    public function getCourseDetails($id)
    {
        return Course::with(['instructor', 'category', 'reviews'])->findOrFail($id);
    }
    public function getRelatedCourses($id)
    {
        $currentCourse = Course::findOrFail($id);
        return Course::where('category_id', $currentCourse->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
    }

    public function createCourse($data)
    {
        return $this->course->create($data);
    }

    public function updateCourse($id, $data)
    {
        $course = $this->course->find($id);
        if ($course) {
            $course->update($data);
            return $course;
        }
        return null;
    }

    public function deleteCourse($id)
    {
        $course = $this->course->find($id);
        if ($course) {
            $course->delete();
            return true;
        }
        return false;
    }

    public function searchCourses($searchTerm)
    {
        return $this->course->where('name', 'like', "%{$searchTerm}%")
            ->orWhere('description', 'like', "%{$searchTerm}%")
            ->get();
    }

    public function getTopRatedCourses($limit = 5)
    {
        return $this->course->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->limit($limit)
            ->get();
    }

    public function getPopularCourses($limit = 5)
    {
        return $this->course->withCount('students')
            ->orderBy('students_count', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getRecentlyAddedCourses($limit = 5)
    {
        return $this->course->orderBy('created_at', 'desc')->limit($limit)->get();
    }


    public function getCoursesByCategory($categoryId)
    {
        return $this->course->where('category_id', $categoryId)->get();
    }

    public function getCourseByInstructor($instructorId)
    {
        return $this->course->where('instructor_id', $instructorId)->get();
    }

    public function getCourseByStudent($studentId)
    {
        return $this->course->whereHas('students', function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        })->get();
    }
}
