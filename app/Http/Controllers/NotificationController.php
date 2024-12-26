<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function read($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        $notification->markAsRead();

        $course = $notification->data['course'] ?? null;
        $courseId = $notification->data['course_id'] ?? null;

        $instructorId = $notification->data['instructor_id'] ?? null;

        if ($course && $courseId) {
            return redirect()->route('courses.show', ['id' => $courseId]);
        }
        if ($instructorId) {
            return redirect()->route('instructor.review', ['id' => $instructorId]);
        }

        // Handle other notification types
        if ($notification->type === 'App\Notifications\CourseRegistrationNotification') {

            return redirect()->route('instructor.review', ['id' => $notification->data['instructor_id']]);
        }
        if ($notification->type === 'App\Notifications\NewLessonNotification') {

            return redirect()->route('courses.content', ['course_id' => $notification->data['course_id']]);
        }
        if ($notification->type === 'App\Notifications\NewCourseEnrolled') {

            return redirect()->route('my-learning');
        }


        return redirect()->route('welcome')->with('error', 'Notification data is invalid.');
    }
    public function clearAll()
    {
        $user = auth()->user();

        $user->notifications()->delete();

        return back()->with('success', 'All notifications have been cleared.');
    }
    public function delete($id)
    {
        $user = auth()->user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted!');
    }
}
