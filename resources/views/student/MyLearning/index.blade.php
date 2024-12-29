@extends('layouts.Layout')

@section('title', 'My Learning')

@section('content')
<div class="container mx-auto py-12 px-2 md:px-4 min-h-screen">
    <h1 class="text-center text-3xl font-bold mb-8">My Learning</h1>

    <!-- Display session messages -->
    @if(session('error'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('error') }}",
                backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                close: true,
                duration: 3000
            }).showToast();
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('success') }}",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                close: true,
                duration: 3000
            }).showToast();
        });
    </script>
    @endif

    @if($courses->isEmpty())
    <div class="bg-blue-100 border border-blue-300 text-blue-700 p-4 rounded text-center">
        You are not enrolled in any courses yet. <a href="{{ route('welcome') }}" class="text-blue-500 underline">Browse
            Courses</a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
        <div
            class="relative bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
            <form action="{{ route('my-learning.delete', $course->id) }}" method="POST" class="absolute top-2 right-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 bg-white rounded-full shadow hover:bg-red-100 transition p-1"
                    title="Delete Course">
                    <i class="fas fa-times"></i>
                </button>
            </form>

            <img src="{{ asset($course->cover_image) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">

            <div class="p-5">
                <a href="{{ route('courses.show', $course->id) }}"
                    class="text-xl inline-block h-16 overflow-ellipsis font-semibold text-gray-800">
                    {{ $course->title }}
                </a>

                <p class="text-gray-500 mt-2 flex items-center truncate">
                    <i class="fas fa-user mr-2"></i> {{ $course->instructor->user->name }}
                </p>

                <div class="relative w-full bg-gray-200 rounded-full h-3 mt-4">
                    <div class="absolute top-0 left-0 h-3 bg-green-500 rounded-full"
                        style="width: {{ $course->pivot->progress_percentage }}%;"></div>
                </div>
                <span class="text-sm text-gray-600 block mt-1">
                    {{ $course->pivot->progress_percentage }}% Complete
                </span>

                @if($course->pivot->expired_date)
                <span class="text-sm text-red-500 block mt-2">
                    <i class="fas fa-calendar-times mr-2"></i>Expires on: {{
                    \Carbon\Carbon::parse($course->pivot->expired_date)->format('F j, Y') }}
                </span>
                @endif

                @if($course->start_date && \Carbon\Carbon::parse($course->start_date) > now())
                <p class="mt-4 text-center text-gray-500">
                    <i class="fa fa-warning"></i>
                    Course starts on {{ \Carbon\Carbon::parse($course->start_date)->format('F j, Y') }}. You can access
                    it then.
                </p>
                @else
                <a href="{{ route('courses.content', $course->id) }}"
                    class="block mt-4 text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                    <i class="fas fa-play-circle mr-2"></i> Continue Learning
                </a>
                @endif

                @if($course->pivot->progress_percentage == 100)
                <a href="{{ route('courses.generate-certificate', $course->id) }}"
                    class="block mt-4 text-center bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition">
                    <i class="fas fa-certificate mr-2"></i> Generate Certificate
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection