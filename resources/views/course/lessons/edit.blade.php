@extends('layouts.Layout')

@section('title', 'Edit Lesson')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Edit Lesson: {{ $lesson->title }}</h1>

    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Course ID -->
        <div>
            <label for="course_id" class="block text-sm font-medium text-gray-700">Course ID</label>
            <input type="text" name="course_id" id="course_id" value="{{ old('course_id', $lesson->course_id) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <!-- Instructor ID -->
        <div>
            <label for="instructor_id" class="block text-sm font-medium text-gray-700">Instructor ID</label>
            <input type="text" name="instructor_id" id="instructor_id"
                value="{{ old('instructor_id', $lesson->instructor_id) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <!-- Lesson Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Lesson Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('title')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Content Type -->
        <div>
            <label for="content_type" class="block text-sm font-medium text-gray-700">Content Type</label>
            <select name="content_type" id="content_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                required>
                <option value="video" {{ $lesson->content_type == 'video' ? 'selected' : '' }}>Video</option>
                <option value="article" {{ $lesson->content_type == 'article' ? 'selected' : '' }}>Article</option>
                <option value="quiz" {{ $lesson->content_type == 'quiz' ? 'selected' : '' }}>Quiz</option>
            </select>
        </div>

        <!-- Resources -->
        <div>
            <label for="resources" class="block text-sm font-medium text-gray-700">Resources (Links/Files)</label>
            <textarea name="resources" id="resources" rows="3"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('resources', $lesson->resources) }}</textarea>
            @error('resources')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Position -->
        <div>
            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
            <input type="number" name="position" id="position" value="{{ old('position', $lesson->position) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('position')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Is Public -->
        <div class="flex items-center">
            <input type="checkbox" name="is_public" id="is_public" value="1"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded" {{ $lesson->is_public ? 'checked' : '' }}>
            <label for="is_public" class="ml-2 block text-sm text-gray-900">Public Lesson</label>
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="notes" id="notes" rows="3"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('notes', $lesson->notes) }}</textarea>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                Update Lesson
            </button>
        </div>
    </form>
</div>
@endsection