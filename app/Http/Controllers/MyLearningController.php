<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyLearningController extends Controller
{
    //
    public function index()
    {
        $courses = auth()->user()->student->courses()->withPivot('progress_percentage', 'expired_date')->get();
        return view('student.MyLearning.index', compact('courses'));
    }
    public function show($course_id)
    {

        $course =
            auth()->user()->student->courses()->withPivot('progress_percentage', 'expired_date')
            ->where('courses.id', $course_id)
            ->first();

        if (!$course) {
            abort(404);
        }



        $lessons = $course->lessons()->get();

        return view('student.MyLearning.show', compact('course', 'lessons'));
    }
}
