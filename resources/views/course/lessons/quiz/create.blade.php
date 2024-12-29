@extends('layouts.Layout')

@section('title', "Quiz for Lesson - {$lesson->title}")

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl sm:text-4xl font-bold mb-6 text-center animate__animated animate__fadeIn animate__delay-1s">Quiz
        for Lesson: {{ $lesson->title }}</h1>

    @if($lesson->quiz)
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl sm:text-2xl font-semibold mb-4 flex items-center">
            <i class="fas fa-clipboard-list mr-2 text-blue-500"></i>Quiz Title: {{ $lesson->quiz->title }}
        </h2>

        <ul class="space-y-4">
            @foreach($lesson->quiz->questions as $question)
            <li>
                <strong class="text-lg sm:text-xl"><i class="fas fa-question-circle mr-2"></i>{{ $question->question
                    }}</strong>
                <ul class="list-disc ml-10 space-y-2">
                    @foreach($question->options as $option)
                    <li class="text-base sm:text-lg "> {{ $option->option }}</li>
                    @endforeach
                </ul>
            </li>
            <hr class="my-4 border-t-2 border-gray-300">
            @endforeach
        </ul>

        <div class="mt-4">
            <a href="{{ route('quiz.edit', $lesson) }}"
                class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 flex items-center justify-center">
                <i class="fas fa-edit mr-2"></i> Edit Quiz
            </a>
        </div>
    </div>
    @else
    <form action="{{ route('quiz.store', $lesson) }}" method="POST" class="space-y-6 mt-6">
        @csrf

        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
            <label for="title"
                class="block text-lg sm:text-xl font-medium sm:w-1/4 sm:mr-4 mb-2 sm:mb-0 flex items-center">
                <i class="fas fa-pencil-alt mr-2"></i> Quiz Title
            </label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter quiz title"
                class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300"
                required>
        </div>

        <div id="questions-container">
            <div class="question mb-6" id="question-0">
                <div class="flex flex-col sm:flex-row sm:items-center mb-4">
                    <label for="question-1"
                        class="block text-lg sm:text-xl font-medium sm:w-1/4 sm:mr-4 mb-2 sm:mb-0 flex items-center">
                        <i class="fas fa-question-circle mr-2"></i> Question 1
                        <i class="remove-question fas fa-trash text-red-500 hover:text-red-700 cursor-pointer ml-2"></i>
                    </label>
                    <input type="text" name="questions[0][question]" placeholder="Enter question"
                        class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300"
                        required>
                </div>

                <div class="options mt-4" id="options-0" data-question-id="0">
                    <label class="block text-lg sm:text-xl font-medium mb-4 flex items-center">
                        <i class="fas fa-list-ul mr-2"></i> Options:
                    </label>

                    <div class="option mb-4" data-option-id="0">
                        <div class="flex items-center mb-2">
                            <input type="text" name="questions[0][options][]" placeholder="Option 1"
                                class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300"
                                required>
                        </div>
                    </div>

                    <div class="option mb-4" data-option-id="1">
                        <div class="flex items-center mb-2">
                            <input type="text" name="questions[0][options][]" placeholder="Option 2"
                                class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300"
                                required>
                        </div>
                    </div>

                    <button type="button"
                        class="add-option mt-2 bg-purple-500 text-white py-2 px-4 rounded mb-4 inline-flex items-center hover:bg-purple-600 focus:outline-none w-full transition duration-300">
                        <i class="fas fa-plus"></i> Add Option
                    </button>

                    <label for="correct_option" class="block text-sm sm:text-base font-medium mt-2 flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-500"></i> Correct Option
                    </label>
                    <select name="questions[0][correct_option]"
                        class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-blue-300 transition duration-300">
                        <option value="0">Option 1</option>
                        <option value="1">Option 2</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="button" id="add-question"
            class="bg-green-500 text-white py-2 px-4 rounded mb-6 inline-flex items-center hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 w-full transition duration-300">
            <i class="fas fa-plus"></i> Add Question
        </button>

        <div class="mt-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300">
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
        newQuestion.classList.add('question', 'mb-6');
        newQuestion.setAttribute('id', `question-${questionCount}`);

        newQuestion.innerHTML = `
            <div class="flex flex-col sm:flex-row sm:items-center mb-4">
                <label for="question-${questionCount}" class="block text-lg sm:text-xl font-medium sm:w-1/4 sm:mr-4 mb-2 sm:mb-0 flex items-center">
                    <i class="fas fa-question-circle mr-2"></i> Question ${questionCount + 1}
                    <i class="remove-question fas fa-trash text-red-500 hover:text-red-700 cursor-pointer ml-2"></i>
                </label>
                <input type="text" name="questions[${questionCount}][question]" placeholder="Enter question" class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300" required>
            </div>

            <div class="options mt-4" id="options-${questionCount}" data-question-id="${questionCount}">
                <label class="block text-lg sm:text-xl font-medium mb-4 flex items-center">
                    <i class="fas fa-list-ul mr-2"></i> Options:
                </label>
                <div class="option mb-4" data-option-id="0">
                    <div class="flex items-center mb-2">
                        <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 1" class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300" required>
                        <button type="button" class="remove-option ml-2 bg-transparent text-red-500 hover:text-red-700 focus:outline-none">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="option mb-4" data-option-id="1">
                    <div class="flex items-center mb-2">
                        <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 2" class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300" required>
                        <button type="button" class="remove-option ml-2 bg-transparent text-red-500 hover:text-red-700 focus:outline-none">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <button type="button" class="add-option mt-2 bg-green-500 text-white py-2 px-4 rounded mb-4 w-full sm:w-auto transition duration-300">
                    <i class="fas fa-plus"></i> Add Option
                </button>

                <label for="correct_option" class="block text-sm sm:text-base font-medium mt-2 flex items-center">
                    <i class="fas fa-check-circle mr-2 text-green-500"></i> Correct Option
                </label>
                <select name="questions[${questionCount}][correct_option]" class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-blue-300 transition duration-300">
                    <option value="0">Option 1</option>
                    <option value="1">Option 2</option>
                </select>
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
                    <div class="flex items-center mb-2">
                        <input type="text" name="questions[${optionsContainer.dataset.questionId}][options][]" placeholder="Option ${optionCount + 1}"
                            class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300" required>
                        <i class="remove-option fas fa-trash ml-2 bg-transparent text-lg text-red-500 hover:text-red-700 focus:outline-none"></i>
                    </div>
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