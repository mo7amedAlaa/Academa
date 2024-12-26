@extends('layouts.Layout')

@section('title', "Edit Quiz for Lesson - {$lesson->title}")

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Edit Quiz for Lesson: {{ $lesson->title }}</h1>

    <form action="{{ route('quiz.update', $lesson) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Quiz Title -->
        <div>
            <label for="title" class="block text-lg font-medium mb-2">Quiz Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}"
                placeholder="Enter quiz title" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>
        </div>

        <div id="questions-container">
            @foreach($quiz->questions as $index => $question)
            <div class="question mb-4" id="question-{{ $index }}">
                <label for="question-{{ $index }}" class="block text-lg font-medium mb-2">Question {{ $index + 1
                    }}</label>
                <input type="text" name="questions[{{ $index }}][question]"
                    value="{{ old('questions.' . $index . '.question', $question->question) }}"
                    placeholder="Enter question" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>

                <div class="options mt-2" id="options-{{ $index }}" data-question-id="{{ $index }}">
                    <label class="block mb-2">Options:</label>
                    @foreach($question->options as $optionIndex => $option)
                    <div class="option mb-4" data-option-id="{{ $optionIndex }}">
                        <input type="text" name="questions[{{ $index }}][options][]"
                            value="{{ old('questions.' . $index . '.options.' . $optionIndex, $option->option) }}"
                            placeholder="Option {{ $optionIndex + 1 }}"
                            class="w-full p-3 border border-gray-300 rounded-lg mb-2" required>
                        <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded">
                            Delete Option
                        </button>
                    </div>
                    @endforeach

                    <button type="button" class="add-option mt-2 bg-green-500 text-white py-2 px-4 rounded mb-4">
                        Add Option
                    </button>

                    <label for="correct_option" class="block text-sm font-medium mt-2">Correct Option</label>
                    <select name="questions[{{ $index }}][correct_option]"
                        class="w-full p-3 border border-gray-300 rounded-lg mb-4">
                        @foreach($question->options as $optionIndex => $option)
                        <option value="{{ $optionIndex }}" @if($question->correct_option == $optionIndex) selected
                            @endif>
                            Option {{ $optionIndex + 1 }}
                        </option>
                        @endforeach
                    </select>

                    <button type="button" class="remove-question mt-2 bg-red-500 text-white py-2 px-4 rounded">
                        Delete Question
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add-question" class="bg-green-500 text-white py-2 px-4 rounded mb-6">
            Add Question
        </button>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded w-full sm:w-auto">
                Update Quiz
            </button>
        </div>
    </form>
</div>

<script>
    let questionCount = {{ count($quiz -> questions) }};

    // Add new question functionality
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
                    <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded">
                        Delete Option
                    </button>
                </div>
                <div class="option mb-4" data-option-id="1">
                    <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 2"
                        class="w-full p-3 border border-gray-300 rounded-lg mb-2" required>
                    <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded">
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

    // Handle adding and removing options dynamically
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
                    <button type="button" class="remove-option mt-2 bg-red-500 text-white py-2 px-4 rounded">
                        Delete Option
                    </button>
                `;
                optionsContainer.insertBefore(newOption, event.target);

                updateCorrectOption(optionsContainer);

                if (optionCount === 5) {
                    event.target.classList.add('hidden');
                }
            }
        }

        if (event.target && event.target.classList.contains('remove-option')) {
            const optionElement = event.target.closest('.option');
            if (optionElement) {
                optionElement.remove();
            }

            // After removing an option, update the correct option select menu
            const optionsContainer = event.target.closest('.options');
            updateCorrectOption(optionsContainer);
        }

        if (event.target && event.target.classList.contains('remove-question')) {
            const questionElement = event.target.closest('.question');
            questionElement.remove();
        }
    });

    function updateCorrectOption(optionsContainer) {
        const options = optionsContainer.querySelectorAll('.option');
        const correctOptionSelect = optionsContainer.querySelector('select');
        correctOptionSelect.innerHTML = '';
        options.forEach((option, index) => {
            const optionElement = document.createElement('option');
            optionElement.value = index;
            optionElement.innerText = `Option ${index + 1}`;
            correctOptionSelect.appendChild(optionElement);
        });
    }
</script>
@endsection