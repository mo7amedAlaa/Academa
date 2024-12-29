<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function create(Lesson $lesson)
    {
        return view('course.lessons.quiz.create', compact('lesson'));
    }

    public function store(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.options.*' => 'required|string',
            'questions.*.correct_option' => 'required|integer|min:0',
        ]);

        $quiz = new Quiz();
        $quiz->lesson_id = $lesson->id;
        $quiz->title = $request->input('title');
        $quiz->save();

        foreach ($request->input('questions') as $questionData) {
            $question = $quiz->questions()->create([
                'question' => $questionData['question'],
                'correct_option' => $questionData['correct_option'],
            ]);

            foreach ($questionData['options'] as $option) {
                $question->options()->create([
                    'option' => $option,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Quiz created successfully!');
    }


    public function edit(Lesson $lesson)
    {
        if (!$lesson->quiz) {
            return redirect()->route('quiz.create', $lesson);
        }

        $quiz = $lesson->quiz;
        $questions = $quiz->questions;
        $options = $questions->mapWithKeys(function ($question) {
            return [$question->id => $question->options];
        })->toArray();
        $questionCount = count($questions);

        return view('course.lessons.quiz.edit', compact('lesson', 'quiz', 'questions', 'options', 'questionCount'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.options' => 'required|array',
            'questions.*.correct_option' => 'required|integer',
        ]);

        $quiz = $lesson->quiz;
        $quiz->title = $request->title;
        $quiz->save();

        // Track the IDs of the questions that were removed
        $updatedQuestionIds = [];

        // Process each question in the request
        foreach ($request->questions as $index => $questionData) {
            // Check if the question already exists in the database
            if (isset($quiz->questions[$index])) {
                $question = $quiz->questions[$index];

                // Update the question text
                $question->question = $questionData['question'];
                $question->save();

                // Delete all the existing options
                $question->options()->delete();

                // Add new options
                foreach ($questionData['options'] as $option) {
                    $question->options()->create([
                        'option' => $option,
                    ]);
                }

                // Update the correct option
                $question->correct_option = $questionData['correct_option'];
                $question->save();

                // Mark this question as updated
                $updatedQuestionIds[] = $question->id;
            } else {
                // If the question doesn't exist, create a new one
                $question = $quiz->questions()->create([
                    'question' => $questionData['question'],
                    'correct_option' => $questionData['correct_option'],
                ]);

                // Create the options for the new question
                foreach ($questionData['options'] as $option) {
                    $question->options()->create([
                        'option' => $option,
                    ]);
                }

                // Mark this question as updated
                $updatedQuestionIds[] = $question->id;
            }
        }

        // Delete questions that were removed from the request
        $quiz->questions->whereNotIn('id', $updatedQuestionIds)->each(function ($question) {
            $question->delete();
        });

        return redirect()->route('quiz.edit', $lesson)->with('success', 'Quiz updated successfully');
    }


    public function start($lesson_id)
    {
        $lesson = Lesson::findOrFail($lesson_id);

        $quiz = $lesson->quiz;


        if (!$quiz) {
            return redirect()->route('courses.content', $lesson->course_id)
                ->with('error', 'No quiz available for this lesson');
        }


        $score = $quiz->score()->first();

        if ($score && $score->user_id == auth()->id()) {
            return redirect()->route('courses.content', $lesson->course_id)
                ->with('error', 'You have already completed this quiz');
        }

        return view('course.lessons.quiz.start', compact('lesson', 'quiz'));
    }

    public function submit(Request $request, $quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        $questions = $quiz->questions;

        $score = 0;

        foreach ($questions as $question) {
            $user_answer = $request->input('question_' . $question->id);

            if ($user_answer == $question->correct_option) {
                $score++;
            }
        }

        $totalQuestions = count($questions);
        $percentage = ($score / $totalQuestions) * 100;

        $existingScore = $quiz->score()->where('user_id', auth()->user()->id)->first();

        if ($existingScore) {
            $existingScore->update([
                'score' => $percentage,
                'lesson_id' => $quiz->lesson_id,
            ]);
        } else {
            $quiz->score()->create([
                'score' => $percentage,
                'user_id' => auth()->user()->id,
                'lesson_id' => $quiz->lesson_id,
            ]);
        }


        return view('course.lessons.quiz.result', compact('quiz', 'score', 'totalQuestions', 'percentage'));
    }
}
