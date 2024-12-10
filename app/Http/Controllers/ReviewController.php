<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Review;
use App\Notifications\ReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function show($id)
    {
        $instructor = Instructor::with('user', 'reviews', 'courses')->findOrFail($id);
        $reviews = $instructor->reviews()->latest()->get();
        $courses = $instructor->courses;

        return view('instructor.review', compact('instructor', 'reviews', 'courses'));
    }
    public function store(Request $request, $entityType, $entityId)
    {
        $request->validate([
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = [
            'user' => auth()->user()->name,
            'rating' => $request->rating,
            'comment' => $request->review,
        ];

        if ($entityType == 'course') {
            $course = Course::findOrFail($entityId);
            Review::create([
                'user_id' => auth()->id(),
                'course_id' => $course->id,
                'instructor_id' => null,
                'comment' => $request->review,
                'rating' => $request->rating,
            ]);
            $instructor = $course->instructor;
            $data['course'] = $course->title;
            $data['course_id'] = $course->id;
            $data['instructor_id'] = null;

            if ($instructor) {
                $instructor->user->notify(new ReviewNotification($data));
            }
        } elseif ($entityType == 'instructor') {
            $instructor = Instructor::findOrFail($entityId);
            Review::create([
                'user_id' => auth()->id(),
                'course_id' => null,
                'instructor_id' => $instructor->id,
                'comment' => $request->review,
                'rating' => $request->rating,
            ]);
            $data['course'] = null;
            $data['course_id'] = null;

            $data['instructor_id'] = $instructor->id;

            $instructor->user->notify(new ReviewNotification($data));
        }

        return back()->with('success', 'Review submitted successfully!');
    }


    public function edit($entityType, $entityId, $reviewId)
    {
        if ($entityType == 'course') {
            $course = Course::findOrFail($entityId);
            $review = Review::where('id', $reviewId)
                ->where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->firstOrFail();
            return view('reviews.edit', compact('course', 'review'));
        } elseif ($entityType == 'instructor') {
            $instructor = Instructor::findOrFail($entityId);
            $review = Review::where('id', $reviewId)
                ->where('user_id', Auth::id())
                ->where('instructor_id', $instructor->id)
                ->firstOrFail();
            return view('reviews.edit', compact('instructor', 'review'));
        }
    }
    public function update(Request $request, $entityType, $entityId, $reviewId)
    {
        $request->validate([
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::findOrFail($reviewId);

        if ($entityType == 'course' && $review->course_id == $entityId) {
            if ($review->user_id != Auth::id()) {
                return back()->with('error', 'You are not authorized to edit this review.');
            }

            $review->update([
                'comment' => $request->review,
                'rating' => $request->rating,
            ]);
        } elseif ($entityType == 'instructor' && $review->instructor_id == $entityId) {
            if ($review->user_id != Auth::id()) {
                return back()->with('error', 'You are not authorized to edit this review.');
            }

            $review->update([
                'comment' => $request->review,
                'rating' => $request->rating,
            ]);
        }

        return back()->with('success', 'Review updated successfully!');
    }

    public function destroy($entityId, $reviewId)
    {
        $review = Review::findOrFail($reviewId);

        if ($review->user_id != Auth::id()) {
            return back()->with('error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }
}
