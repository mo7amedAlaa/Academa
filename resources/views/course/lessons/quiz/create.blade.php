@extends('layouts.Layout')

@section('title', "Quiz for Lesson - {$lesson->title}")

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Quiz for Lesson: {{ $lesson->title }}</h1>

    @if($lesson->quiz)
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Quiz Title: {{ $lesson->quiz->title }}</h2>
        <ul class="space-y-4">
            @foreach($lesson->quiz->questions as $question)
            <li>
                <strong>{{ $question->question }}</strong>
                <ul class="list-disc ml-6 space-y-2">
                    @foreach($question->options as $option)
                    <li>{{ $option->option }}</li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
        <div class="mt-4">
            <a href="{{ route('quiz.edit', $lesson) }}"
                class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Edit Quiz
            </a>
        </div>
    </div>
    @else
    <!-- If no quiz exists, show the create quiz form -->
    <form action="{{ route('quiz.store', $lesson) }}" method="POST" class="space-y-6 mt-6">
        @csrf

        <div>
            <label for="title" class="block text-lg font-medium mb-2">Quiz Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter quiz title"
                class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>
        </div>

        <div id="questions-container">
            <div class="question mb-4" id="question-0">
                <label for="question-1" class="block text-lg font-medium mb-2">Question 1</label>
                <input type="text" name="questions[0][question]" placeholder="Enter question"
                    class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>

                <div class="options mt-2" id="options-0" data-question-id="0">
                    <label class="block mb-2">Options:</label>
                    <div class="option mb-4" data-option-id="0">
                        <input type="text" name="questions[0][options][]" placeholder="Option 1"
                            class="w-full p-3 border border-gray-300 rounded-lg mb-2" required>
                        <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded hidden">
                            Delete Option
                        </button>
                    </div>
                    <div class="option mb-4" data-option-id="1">
                        <input type="text" name="questions[0][options][]" placeholder="Option 2"
                            class="w-full p-3 border border-gray-300 rounded-lg mb-2" required>
                        <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded hidden">
                            Delete Option
                        </button>
                    </div>

                    <button type="button" class="add-option mt-2 bg-green-500 text-white py-2 px-4 rounded mb-4">
                        Add Option
                    </button>
                    <label for="correct_option" class="block text-sm font-medium mt-2">Correct Option</label>
                    <select name="questions[0][correct_option]"
                        class="w-full p-3 border border-gray-300 rounded-lg mb-4">
                        <option value="0">Option 1</option>
                        <option value="1">Option 2</option>
                    </select>
                    <button type="button" class="remove-question mt-2 bg-red-500 text-white py-2 px-4 rounded">
                        Delete Question
                    </button>
                </div>
            </div>
        </div>

        <button type="button" id="add-question" class="bg-green-500 text-white py-2 px-4 rounded mb-6">
            Add Question
        </button>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded w-full sm:w-auto">
                Save Quiz
            </button>
        </div>
    </form>
    @endif
</div>

<script>
    let questionCount = 1;

    document.getElementById('add-question').addEventListener('click', function () {
        const questionsContainer = document.getElementById('questions-container');
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('question', 'mb-4');
        newQuestion.setAttribute('id', `question-${questionCount}`);

        newQuestion.innerHTML = `
            <label for="question-${questionCount}" class="block text-lg font-medium mb-2">Question ${questionCount + 1}</label>
            <input type="text" name="questions[${questionCount}][question]" placeholder="Enter question" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>

            <div class="options mt-2" id="options-${questionCount}" data-question-id="${questionCount}">
                <label class="block mb-2">Options:</label>
                <div class="option mb-4" data-option-id="0">
                    <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 1"
                        class="w-full p-3 border border-gray-300 rounded-lg mb-2" required>
                    <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded hidden">
                        Delete Option
                    </button>
                </div>
                <div class="option mb-4" data-option-id="1">
                    <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 2"
                        class="w-full p-3 border border-gray-300 rounded-lg mb-2" required>
                    <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded hidden">
                        Delete Option
                    </button>
                </div>

                <label for="correct_option" class="block text-sm font-medium mt-2">Correct Option</label>
                <select name="questions[${questionCount}][correct_option]" class="w-full p-3 border border-gray-300 rounded-lg mb-4">
                    <option value="0">Option 1</option>
                    <option value="1">Option 2</option>
                </select>

                <button type="button" class="add-option mt-2 bg-green-500 text-white py-2 px-4 rounded mb-4">
                    Add Option
                </button>
                <button type="button" class="remove-question mt-2 bg-red-500 text-white py-2 px-4 rounded">
                    Delete Question
                </button>
            </div>
        `;

        questionsContainer.appendChild(newQuestion);
        questionCount++;
    });

    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('add-option')) {
            const optionsContainer = event.target.closest('.options');
            const options = optionsContainer.querySelectorAll('.option');
            const optionCount = options.length;

            if (optionCount < 6) {
                const newOption = document.createElement('div');
                newOption.classList.add('option', 'mb-4');
                newOption.setAttribute('data-option-id', optionCount);
                newOption.innerHTML = `
                    <input type="text" name="questions[${optionsContainer.dataset.questionId}][options][]" placeholder="Option ${optionCount + 1}"
                        class="w-full p-3 border border-gray-300 rounded-lg mb-2" required>
                    <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded hidden">
                        Delete Option
                    </button>
                `;
                optionsContainer.insertBefore(newOption, event.target);

                updateCorrectOption(optionsContainer);

                if (optionCount === 5) {
                    event.target.classList.add('hidden');
                }

                const removeOptionBtn = newOption.querySelector('.remove-option');
                removeOptionBtn.classList.remove('hidden');
            }
        }

        if (event.target && event.target.classList.contains('remove-option')) {
            const optionsContainer = event.target.closest('.options');
            const options = optionsContainer.querySelectorAll('.option');
            if (options.length > 2) {
                const lastOption = options[options.length - 1];
                lastOption.remove();

                updateCorrectOption(optionsContainer);

                const addOptionBtn = optionsContainer.querySelector('.add-option');
                addOptionBtn.classList.remove('hidden');
            }
        }

        if (event.target && event.target.classList.contains('remove-question')) {
            const question = event.target.closest('.question');
            question.remove();
        }
    });

    function updateCorrectOption(optionsContainer) {
        const options = optionsContainer.querySelectorAll('.option');
        const correctOptionSelect = optionsContainer.querySelector('select');

        correctOptionSelect.innerHTML = '';

        options.forEach((option, index) => {
            const optionText = option.querySelector('input').value || `Option ${index + 1}`;
            const newOption = document.createElement('option');
            newOption.value = index;
            newOption.textContent = optionText;
            correctOptionSelect.appendChild(newOption);
        });
    }
</script>

@endsection