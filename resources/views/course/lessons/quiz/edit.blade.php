@extends('layouts.Layout')

@section('title', "Edit Quiz for Lesson - {$lesson->title}")

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl sm:text-4xl font-bold mb-6 text-center animate__animated animate__fadeIn animate__delay-1s">Edit
        Quiz for Lesson: {{ $lesson->title }}</h1>

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

    <form action="{{ route('quiz.update', $lesson) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-lg sm:text-xl font-medium mb-2"><i
                    class="fas fa-pencil-alt mr-2"></i>Quiz Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}"
                placeholder="Enter quiz title"
                class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-blue-300 transition duration-300"
                required>
        </div>

        <div id="questions-container">
            @foreach($quiz->questions as $index => $question)
            <div class="question mb-6" id="question-{{ $index }}">
                <div class="flex flex-col sm:flex-row sm:items-center mb-4">
                    <label for="question-{{ $index }}"
                        class="block text-lg sm:text-xl font-medium sm:w-1/4 sm:mr-4 mb-2 sm:mb-0 flex items-center">
                        <i class="fas fa-question-circle mr-2"></i>Question {{ $index + 1 }}
                        <i class="remove-question fas fa-trash text-red-500 hover:text-red-700 cursor-pointer ml-2"></i>
                    </label>
                    <input type="text" name="questions[{{ $index }}][question]"
                        value="{{ old('questions.' . $index . '.question', $question->question) }}"
                        placeholder="Enter question"
                        class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-blue-300 transition duration-300"
                        required>
                </div>

                <div class="options mt-4" id="options-{{ $index }}" data-question-id="{{ $index }}">
                    <label class="block text-lg sm:text-xl font-medium mb-4 flex items-center">
                        <i class="fas fa-list-ul mr-2"></i>Options:
                    </label>

                    @foreach($question->options as $optionIndex => $option)
                    <div class="option mb-4" data-option-id="{{ $optionIndex }}">
                        <div class="flex items-center mb-2">
                            <input type="text" name="questions[{{ $index }}][options][]"
                                value="{{ old('questions.' . $index . '.options.' . $optionIndex, $option->option) }}"
                                placeholder="Option {{ $optionIndex + 1 }}"
                                class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300"
                                required>

                            <i
                                class="ml-2 remove-option fas fa-trash text-red-500 hover:text-red-700 focus:outline-none"></i>

                        </div>
                    </div>
                    @endforeach

                    <button type="button"
                        class="add-option mt-2 bg-purple-500 text-white py-2 px-4 rounded mb-4 inline-flex items-center hover:bg-purple-600 focus:outline-none w-full transition duration-300">
                        <i class="fas fa-plus"></i> Add Option
                    </button>

                    <label for="correct_option" class="block text-sm sm:text-base font-medium mt-2 flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-500"></i>Correct Option
                    </label>
                    <select name="questions[{{ $index }}][correct_option]"
                        class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-blue-300 transition duration-300">
                        @foreach($question->options as $optionIndex => $option)
                        <option value="{{ $optionIndex }}" @if($question->correct_option == $optionIndex) selected
                            @endif>
                            Option {{ $optionIndex + 1 }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add-question"
            class="bg-green-500 text-white py-2 px-4 rounded mb-6 inline-flex items-center hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 w-full transition duration-300">
            <i class="fas fa-plus"></i> Add Question
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

    document.getElementById('add-question').addEventListener('click', function () {
        const questionsContainer = document.getElementById('questions-container');
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('question', 'mb-6');
        newQuestion.setAttribute('id', `question-${questionCount}`);

        newQuestion.innerHTML = `
            <div class="question mb-6" id="question-${questionCount}">
                <div class="flex flex-col sm:flex-row sm:items-center mb-4">
                    <label for="question-${questionCount}" class="block text-lg sm:text-xl font-medium sm:w-1/4 sm:mr-4 mb-2 sm:mb-0 flex items-center">
                        <i class="fas fa-question-circle mr-2"></i>Question ${questionCount + 1}
                        <i class="remove-question fas fa-trash text-red-500 hover:text-red-700 cursor-pointer ml-2"></i>
                    </label>
                    <input type="text" name="questions[${questionCount}][question]" placeholder="Enter question" class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-blue-300 transition duration-300" required>
                </div>

                <div class="options mt-4" id="options-${questionCount}" data-question-id="${questionCount}">
                    <label class="block text-lg sm:text-xl font-medium mb-4 flex items-center">
                        <i class="fas fa-list-ul mr-2"></i>Options:
                    </label>

                    <div class="option mb-4" data-option-id="0">
                        <div class="flex items-center mb-2">
                            <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 1"
                                class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300" required>
                            <i class="ml-2 remove-option fas fa-trash text-red-500 hover:text-red-700 focus:outline-none"></i>
                        </div>
                    </div>

                    <div class="option mb-4" data-option-id="1">
                        <div class="flex items-center mb-2">
                            <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 2"
                                class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-300" required>
                            <i class="ml-2 remove-option fas fa-trash text-red-500 hover:text-red-700 focus:outline-none"></i>
                        </div>
                    </div>

                    <label for="correct_option" class="block text-sm sm:text-base font-medium mt-2 flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-500"></i>Correct Option
                    </label>
                    <select name="questions[${questionCount}][correct_option]" class="w-full sm:w-3/4 p-3 text-base sm:text-lg border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-blue-300 transition duration-300">
                        <option value="0">Option 1</option>
                        <option value="1">Option 2</option>
                    </select>

                    <button type="button" class="add-option mt-2 bg-purple-500 text-white py-2 px-4 rounded mb-4 inline-flex items-center hover:bg-purple-600 focus:outline-none w-full transition duration-300">
                        <i class="fas fa-plus"></i> Add Option
                    </button>

                    <button type="button" class="remove-question mt-2 bg-red-500 text-white py-2 px-4 rounded">
                        Delete Question
                    </button>
                </div>
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
                        <i class="ml-2 remove-option fas fa-trash text-red-500 hover:text-red-700 focus:outline-none"></i>
                    </div>
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