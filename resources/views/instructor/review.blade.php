@extends('layouts.Layout')
@section('title', 'Reviews')
@section('content')
<div class="container mx-auto my-8">
    {{-- Instructor Information --}}
    <div class="flex items-center bg-gray-100 p-6 rounded-lg shadow">
        <img src="{{ asset($instructor->user->avatar) }}" alt="{{ $instructor->user->name }}"
            class="w-24 h-24 rounded-full object-cover mr-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $instructor->user->name }}</h1>
            <p class="text-gray-600 text-sm">{{ $instructor->bio }}</p>
            <p class="text-gray-700 mt-2">Experience: <strong>{{ $instructor->experience_years }} years</strong></p>
            <p class="text-gray-700">Nationality: <strong>{{ $instructor->nationality }}</strong></p>
            <p class="text-gray-700">Phone: <strong>{{ $instructor->phone }}</strong></p>
        </div>
    </div>

    {{-- Courses Section --}}
    <div class="my-8">
        <h2 class="text-xl font-bold text-gray-800">Courses</h2>
        @if($courses->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach($courses as $course)
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-bold text-gray-800">{{ $course->title }}</h3>
                <p class="text-gray-600 text-sm">{{ Str::limit($course->description, 100) }}</p>
                <p class="text-gray-700 mt-2">Price: <strong>${{ $course->price }}</strong></p>
                <a href="{{ route('courses.show', $course->id) }}" class="text-blue-500 mt-4 inline-block">View
                    Course</a>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-600">No courses available for this instructor.</p>
        @endif
    </div>

    {{-- Review Section --}}
    <div class="my-8">
        <h2 class="text-xl font-bold text-gray-800">Reviews</h2>

        {{-- Review Form --}}
        @auth
        @php
        $userReview = $reviews->firstWhere('user_id', auth()->id());
        @endphp

        @if($userReview)
        {{-- If user has already reviewed, show their review with edit/delete options --}}
        <div class="bg-gray-100 p-4 rounded-lg shadow mt-4">
            <div class="flex justify-between items-center">
                <p class="text-gray-700 font-bold">Your Review</p>
                <div>
                    <a href="{{ route('review.edit', ['entityType' => 'instructor', 'entityId' => $instructor->id,'reviewId'=>$userReview->id]) }}"
                        class="text-blue-500 underline mr-4">Edit</a>
                    <form action="{{ route('reviews.destroy', [$instructor->id,$userReview->id]) }}" method="POST"
                        class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 underline">Delete</button>
                    </form>
                </div>
            </div>
            <p class="text-yellow-500 font-bold">{{ $userReview->rating }} / 5</p>
            <p class="mt-2 text-gray-700">{{ $userReview->comment }}</p>
        </div>
        @else
        {{-- Show review form if no review exists for the user --}}
        <form action="{{ route('review.store', ['entityType' => 'instructor', 'entityId' => $instructor->id]) }}"
            method="POST" class="bg-gray-100 p-4 rounded-lg shadow mt-4">
            @csrf
            <div class="mb-4">
                <label for="rating" class="block text-gray-700 font-bold">Rating:</label>
                <select name="rating" id="rating" class="w-full p-2 border rounded">
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="review" class="block text-gray-700 font-bold">Comment:</label>
                <textarea name="review" id="review" rows="4" class="w-full p-2 border rounded"
                    placeholder="Write your review..."></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Submit
                Review</button>
        </form>
        @endif
        @else
        <p class="text-gray-700 mt-4">Please <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> to
            leave a review.</p>
        @endauth

        {{-- Reviews List --}}
        <div class="mt-6">
            @forelse($reviews->where('user_id', '!=', auth()->id()) as $review)
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <div class="flex justify-between">
                    <div>
                        <p class="text-gray-700 font-bold">{{ $review->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                    <div>
                        <p class="text-yellow-500 font-bold">{{ $review->rating }} / 5</p>
                    </div>
                </div>
                <p class="mt-2 text-gray-700">{{ $review->comment }}</p>
            </div>
            @empty
            <p class="text-gray-600">No reviews yet. Be the first to leave a review!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection