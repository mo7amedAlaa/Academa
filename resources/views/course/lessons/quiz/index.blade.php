@extends('layouts.app')

@section('title', 'Quiz')

@section('content')
<div class="container py-8">
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg mb-6">
        <h1 class="text-3xl font-bold">Quiz: {{ $lesson->title }}</h1>
        <p class="mt-2">Test your knowledge on this lesson!</p>
    </div>

    @if (session('score'))
    <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
        <p>You scored {{ session('score') }}/{{ session('total') }}!</p>
    </div>
    @endif

    <form method="POST" action="{{ route('quiz.submit', $lesson->id) }}" class="space-y-6">
        @csrf

        @foreach ($lesson->quiz->questions as $index => $question)
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">{{ $index + 1 }}. {{ $question->question }}</h2>
            <div class="mt-4 space-y-2">
                @foreach (['a', 'b', 'c', 'd'] as $option)
                <label class="flex items-center space-x-3">
                    <input type="radio" name="answer_{{ $question->id }}" value="{{ $option }}"
                        class="form-radio text-blue-500">
                    <span>{{ $question["option_$option"] }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold mt-6">
            Submit Quiz
        </button>
    </form>
</div>
@endsection
