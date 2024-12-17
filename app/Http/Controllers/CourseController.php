<?php

namespace App\Http\Controllers;

use App\Dto\CourseDto;
use App\Models\Course;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Services\Facades\CourseFacade;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = CourseFacade::create();
        return view('course.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        if (CourseFacade::store(CourseDto::formArray(request: $request))) {

            return redirect()->route('courses.create')->with('success', 'Course created successfully.');
        }
        return redirect()->route('courses.create')->with('error', 'Course created faild.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $courseDetails = CourseFacade::getCourseDetails($id);
        $relatedCourses = CourseFacade::getRelatedCourses($id);
        $userReview = $courseDetails->reviews()->where('user_id', auth()->id())->first();
        $hasReviewed = $userReview ? true : false;

        return view('course.details', [
            'course' => $courseDetails,
            'relatedCourses' => $relatedCourses,
            'userReview' => $userReview,
            'hasReviewed' => $hasReviewed,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $levels = CourseLevel::all();
        return view('course.edit', compact('levels', 'course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'max_students' => 'nullable|integer|min:1',
            'duration_hours' => 'nullable|integer|min:1',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
            'isFree' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:course_levels,id',
        ]);

        $cover_imagePath = $course->cover_image;

        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            $cover_image = $request->file('cover_image');
            $cover_imageName = uniqid('cover_image_') . '.' . $cover_image->getClientOriginalExtension();
            $cover_image->move(public_path('uploads/courses/'), $cover_imageName);
            $cover_imagePath = "uploads/courses/" . $cover_imageName;
        }

        $course->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'discount' => $validated['discount'],
            'max_students' => $validated['max_students'],
            'duration_hours' => $validated['duration_hours'],
            'cover_image' => $cover_imagePath,
            'start_date' => $validated['start_date'],
            'status' => $validated['status'],
            'isFree' => $validated['isFree'] ?? false,
            'category_id' => $validated['category_id'],
            'level_id' => $validated['level_id'],
        ]);

        return redirect()->back()->with('success', 'Course updated successfully!');
    }


    public function destroy(Course $course)
    {


        // Delete the course
        $course->delete();

        return redirect()->route('instructors.dashboard')->with('success', 'Course deleted successfully!');
    }
    public function manageContent(Course $course, Request $request)
    {

        if ($course->instructor_id !== auth()->user()->instructor->id) {
            return redirect()->route('welcome')->with('error', 'You are not authorized to manage this course content.');
        }

        $query = $course->lessons();
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('content_type')) {
            $query->where('content_type', 'like', '%' . $request->content_type . '%');
        }


        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        if ($request->filled('is_public')) {
            $query->where('is_public', $request->is_public);
        }

        $lessons = $query->get();


        return view('course.manage-content', compact('course', 'lessons'));
    }
}
