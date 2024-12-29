@extends('layouts.Layout')

@section('title', "Manage Content - $course->title")

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-lg md:text-3xl  font-bold mb-6 text-center md:text-left flex items-center gap-2">
        <i class="fas fa-cogs text-blue-600"></i> Manage Content for {{ $course->title }}
    </h1>

    <a href="{{ route('lessons.create', $course) }}"
        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mb-4 inline-block flex items-center gap-2">
        <i class="fas fa-plus-circle"></i> Add New Lesson
    </a>

    <form action="{{ route('instructor.courses.content', $course) }}" method="GET"
        class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-gray-50 p-4 rounded shadow">
        <div>
            <input type="text" name="title" placeholder="Search by Title" value="{{ request('title') }}"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <input type="text" name="content_type" placeholder="Search by Content Type"
                value="{{ request('content_type') }}"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <input type="number" name="position" placeholder="Search by Position" value="{{ request('position') }}"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <select name="is_public"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">All</option>
                <option value="1" {{ request('is_public')=='1' ? 'selected' : '' }}>Public</option>
            </select>
        </div>

        <div class="col-span-full flex gap-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded w-full flex items-center gap-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('instructor.courses.content', $course) }}"
                class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded w-full text-center flex items-center justify-center gap-2">
                <i class="fas fa-undo"></i> Reset
            </a>
        </div>
    </form>

    @if($lessons->isEmpty())
    <p class="text-gray-700 text-center">No lessons found for this course.</p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border text-left">Position</th>
                    <th class="py-2 px-4 border text-left">Lesson Title</th>
                    <th class="py-2 px-4 border text-left">Content Type</th>
                    <th class="py-2 px-4 border text-left">Is Public</th>
                    <th class="py-2 px-4 border text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lessons as $lesson)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border">{{ $lesson->position }}</td>
                    <td class="py-2 px-4 border">{{ $lesson->title }}</td>
                    <td class="py-2 px-4 border">{{ $lesson->content_type }} </td>
                    <td class="py-2 px-4 border">{{ $lesson->is_public ? 'yes' : 'no' }} </td>
                    <td class="py-2 px-4 border">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('lessons.edit', $lesson) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg text-sm flex items-center gap-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg text-sm flex items-center gap-1">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>

                            @if($lesson->content_type === 'quiz')
                            <a href="{{ route('quiz.create', $lesson) }}"
                                class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg text-sm flex items-center gap-1">
                                <i class="fas fa-clipboard-list"></i> Form Quiz
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection