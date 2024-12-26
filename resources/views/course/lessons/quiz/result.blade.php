@extends('layouts.Layout')

@section('title', 'Quiz Results')

@section('content')
<div class="container mx-auto my-5 min-h-screen">
    <h1 class="text-center text-3xl font-bold mb-4">Quiz Results for: {{ $quiz->title }}</h1>

    <div class="text-center">
        <p class="text-xl">You answered <strong>{{ $score }}</strong> out of <strong>{{ $totalQuestions }}</strong>
            questions correctly.</p>
        <p class="text-lg">Your score: <strong>{{ $percentage }}%</strong></p>

        <div class="mt-4">
            <a href="{{ route('courses.show', $quiz->lesson->course_id) }}"
                class="bg-blue-500 text-white py-2 px-4 rounded-lg">Back to Course</a>
        </div>
    </div>
</div>
@endsection