<!-- resources/views/quizzes/start.blade.php -->

@extends('layouts.Layout')

@section('title', 'Start Quiz: ' . $lesson->title)

@section('content')
<div class="container mx-auto my-5 min-h-screen">
    <h1 class="text-center text-3xl font-bold mb-4">{{ $lesson->title }}</h1>

    @if(session('error'))
    <div class="alert alert-danger mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="quiz-container">
        <h3 class="text-2xl font-semibold mb-4">Quiz: {{ $quiz->title }}</h3>

        <!-- Display Quiz Questions -->
        <form action="{{ route('quiz.submit', ['quiz_id' => $quiz->id]) }}" method="POST">
            @csrf
            @foreach ($quiz->questions as $question)
            <div class="question mb-6">
                <p><strong>{{ $question->question }}</strong></p>

                @foreach ($question->options as $index => $option)
                <div class="option">
                    <input type="radio" name="question_{{ $question->id }}" value="{{ $index  }}"
                        id="option_{{ $option->id }}">
                    <label for="option_{{ $option->id }}">{{ $option->option }}</label>
                </div>
                @endforeach
            </div>
            @endforeach

            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg">Submit Quiz</button>
        </form>
    </div>
</div>
@endsection