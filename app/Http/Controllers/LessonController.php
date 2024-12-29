<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonStatus;
use App\Notifications\NewLessonNotification;
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
            'content_type' => 'required|in:video,image,link,quiz,pdf',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,pdf',
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
        foreach ($course->students as $student) {
            $student->user->notify(new NewLessonNotification($request->title, $course->title, $course->instructor->user->name, $course->id));
        }

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
     * make a lesson complete

     */
    public function complete($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);

        if (!$lesson) {
            return redirect()->back()->with('error', 'Lesson not found!');
        }

        $course = $lesson->course;
        $user = auth()->user();
        $student = $user->student;

        $lessonStatus = $student->lessonStatus()->where('lesson_id', $lesson->id)->first();
        if (!$lessonStatus) {
            $lessonStatus = new LessonStatus();
            $lessonStatus->student_id = $student->id;
            $lessonStatus->course_id = $course->id;
            $lessonStatus->lesson_id = $lesson->id;
            $lessonStatus->status = 'completed';
            $lessonStatus->save();
        } else {

            $lessonStatus->status = 'completed';
            $lessonStatus->save();
            return redirect()->back()->with('error', 'Lesson already marked as complete and progress Don`t  updated!');
        }

        $totalLessons = $course->lessons->count();
        $completedLessons = $student->lessonStatus()
            ->where('status', 'completed')
            ->where('course_id', $course->id)
            ->count();



        $progressPercentage = min(($completedLessons / $totalLessons) * 100, 100);

        $student->courses()->updateExistingPivot($course->id, ['progress_percentage' => $progressPercentage]);

        return redirect()->back()->with('success', 'Lesson marked as complete and progress updated!');
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
