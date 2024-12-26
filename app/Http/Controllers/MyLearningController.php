<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyLearningController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->student->courses()
            ->withPivot('progress_percentage', 'expired_date')
            ->get();

        return view('student.MyLearning.index', compact('courses'));
    }

    public function show($course_id)
    {
        $course = auth()->user()->student->courses()
            ->withPivot('progress_percentage', 'expired_date')
            ->where('courses.id', $course_id)
            ->first();

        if (!$course || ($course->pivot->expired_date && Carbon::now()->greaterThan($course->pivot->expired_date))) {
            return redirect()->route('my-learning')->with('error', 'Course not found or expired.');
        }

        $lessons = $course->lessons()->orderBy('position')->get();

        return view('student.MyLearning.show', compact('course', 'lessons'));
    }

    public function destroy($course_id)
    {
        $student = auth()->user()->student;
        $course = $student->courses()->where('courses.id', $course_id)->first();

        if (!$course) {
            abort(404, 'Course not found.');
        }
        $student->lessonStatus()
            ->where('course_id', $course_id)
            ->delete();

        $student->courses()->detach($course_id);

        return redirect()->route('my-learning')->with('success', 'Course removed successfully.');
    }
    public function addToLearning(Request $request)
    {
        $courseId = $request->input('course_id');
        $user = Auth::user();

        if (!$user || !$user->student) {
            return redirect()->route('login')->with('error', 'You must be logged in as a student to add courses.');
        }

        $course = Course::find($courseId);

        if (!$course) {
            return back()->with('error', 'Course not found.');
        }

        if (!$course->isFree) {
            return back()->with('error', 'This course is not free.');
        }

        if ($course->status !== 'published') {
            return back()->with('error', 'This course is not currently published.');
        }

        if ($course->students->count() >= $course->max_students) {
            return back()->with('error', 'This course has reached the maximum number of students.');
        }

        $registrationDate = now();
        $expiredDate = $registrationDate->copy()->addHours($course->duration_hours);

        $user->student->courses()->syncWithoutDetaching([
            $courseId => [
                'progress_percentage' => 0,
                'expired_date' => $expiredDate,
                'registration_date' => $registrationDate,
            ]
        ]);

        return back()->with('success', 'Course added to your learning list!');
    }
}
