@extends('layouts.Layout')

@section('title', 'Create New Lesson')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Create New Lesson</h1>

    <form action="{{ route('lessons.store', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Lesson Title <span
                    class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter lesson title"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('title')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="content_type" class="block text-sm font-medium text-gray-700">Content Type <span
                    class="text-red-500">*</span></label>
            <select name="content_type" id="content_type"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="" disabled {{ old('content_type') ? '' : 'selected' }}>Select content type</option>
                <option value="video" {{ old('content_type')=='video' ? 'selected' : '' }}>Video</option>
                <option value="image" {{ old('content_type')=='image' ? 'selected' : '' }}>Image</option>
                <option value="link" {{ old('content_type')=='link' ? 'selected' : '' }}>Link</option>
                <option value="quiz" {{ old('content_type')=='quiz' ? 'selected' : '' }}>Quiz</option>
                <option value="practice" {{ old('content_type')=='practice' ? 'selected' : '' }}>Practice</option>
            </select>
            @error('content_type')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div id="quiz-button-container"
            class="hidden bg-blue-100 p-4 rounded-lg shadow-md transform transition-all duration-300 ease-in-out">
            <p class="text-sm text-gray-700 font-semibold">
                <span class="text-blue-600">Note:</span> To create a quiz, first create a lesson of type "quiz" and then
                you can
                form quizzes in the main Dashboard.
            </p>
        </div>

        <div id="media-container" style="display: none;">
            <label for="media" class="block text-sm font-medium text-gray-700">Upload Media</label>
            <input type="file" name="media" id="media" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('media')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div id="link-container" style="display: none;">
            <label for="link" class="block text-sm font-medium text-gray-700">External Link</label>
            <input type="url" name="link" id="link" value="{{ old('link') }}"
                placeholder="Enter external link (if applicable)"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('link')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
            <input type="number" name="position" id="position" value="{{ old('position') }}"
                placeholder="Enter position in the course"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('position')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_public" id="is_public" value="1"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded" {{ old('is_public') ? 'checked' : '' }}>
            <label for="is_public" class="ml-2 block text-sm text-gray-900">Public Lesson</label>
        </div>

        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="notes" id="notes" rows="4" placeholder="Add any additional notes (optional)"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('notes') }}</textarea>
            @error('notes')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                Create Lesson
            </button>
        </div>
    </form>

</div>

<script>
    const contentTypeSelect = document.getElementById('content_type');
    const mediaContainer = document.getElementById('media-container');
    const linkContainer = document.getElementById('link-container');
    const quizButtonContainer = document.getElementById('quiz-button-container');

    function handleContentTypeChange() {
        const selectedContentType = contentTypeSelect.value;

        mediaContainer.style.display = 'none';
        linkContainer.style.display = 'none';
        quizButtonContainer.style.display = 'none';

        if (selectedContentType === 'video' || selectedContentType === 'image') {
            mediaContainer.style.display = 'block';
        }

        if (selectedContentType === 'link') {
            linkContainer.style.display = 'block';
        }

        if (selectedContentType === 'quiz') {
            quizButtonContainer.style.display = 'block';
        }
    }

    contentTypeSelect.addEventListener('change', handleContentTypeChange);

    handleContentTypeChange();
</script>
@endsection