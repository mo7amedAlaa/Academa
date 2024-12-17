@extends('layouts.Layout')

@section('title', 'My Learning')

@section('content')
<div class="container mx-auto  py-12 px-2 md:px-4 min-h-screen">
    <h1 class="text-center text-3xl font-bold mb-8">My Learning</h1>

    @if($courses->isEmpty())
    <div class="bg-blue-100 border border-blue-300 text-blue-700 p-4 rounded text-center">
        You are not enrolled in any courses yet. <a href="{{ route('welcome') }}" class="text-blue-500 underline">Browse
            Courses</a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="{{ asset($course->cover_image) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
            <div class="p-5">

                <a href="{{route('courses.show',$course->id)}}"
                    class="text-xl inline-block  h-16 overflow-ellipsis   font-semibold text-gray-800"> {{
                    $course->title }} </a>

                <p class="text-gray-500 mt-2 flex items-center truncate">
                    <i class="fas fa-user mr-2"></i> {{ $course->instructor->user->name }}
                </p>
                <div class="relative w-full bg-gray-200 rounded-full h-3 mt-4">
                    <div class="absolute top-0 left-0 h-3 bg-green-500 rounded-full"
                        style="width: {{ $course->pivot->progress_percentage }}%;">
                    </div>
                </div>
                <span class="text-sm text-gray-600 block mt-1">
                    {{ $course->pivot->progress_percentage }}% Complete
                </span>
                <a href="{{ route('courses.content', $course->id) }}"
                    class="block mt-4 text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                    Continue Learning
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection