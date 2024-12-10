<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Show the form to create a new lesson for a specific course.
     */
    public function create(Course $course)
    {
        return view('course.lessons.create', compact('course'));
    }

    /**
     * Store a newly created lesson in storage.
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:video,image,link,quiz,practice',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov', // Adjust file types and size as needed
            'link' => 'nullable|url|max:255',
            'position' => 'nullable|integer|min:1',
            'is_public' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('media') && $request->file('media')->isValid()) {
            $media = $request->file('media');
            $mediaName = uniqid('media_') . '.' . $media->getClientOriginalExtension();
            $media->move(public_path('uploads/media/'), $mediaName);
            $validated['media'] = "uploads/media/" . $mediaName;
        }


        $validated['course_id'] = $course->id;
        $validated['instructor_id'] = $course->instructor->id;

        $course->lessons()->create($validated);

        return redirect()->route('instructor.courses.content', $course)
            ->with('success', 'Lesson added successfully!');
    }

    /**
     * Show the form to edit an existing lesson.
     */
    public function edit(Lesson $lesson)
    {
        return view('course.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified lesson in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:video,image,link,quiz,practice',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov', // Adjust file types and size as needed
            'link' => 'nullable|url|max:255',
            'position' => 'nullable|integer|min:1',
            'is_public' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('media') && $request->file('media')->isValid()) {
            $media = $request->file('media');
            $mediaName = uniqid('media_') . '.' . $media->getClientOriginalExtension();
            $media->move(public_path('uploads/media/'), $mediaName);
            $validated['media'] = "uploads/media/" . $mediaName;
        }

        $lesson->update($validated);

        return redirect()->route('instructor.courses.content', $lesson->course_id)
            ->with('success', 'Lesson updated successfully!');
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('instructor.courses.content', $lesson->course_id)
            ->with('success', 'Lesson deleted successfully!');
    }
}
