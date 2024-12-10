@extends('layouts.Layout')

@section('title', 'Instructor Dashboard')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Welcome Section -->
    <div
        class="col-span-1 lg:col-span-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow-md">
        <h1 class="text-4xl font-bold">Welcome, {{ $user->name }}!</h1>
        <p class="text-lg mt-2">Here's an overview of your instructor activities.</p>
    </div>

    <!-- Courses Management Section -->
    <div class="bg-white rounded-lg shadow-md p-6 col-span-2">
        <h2 class="text-2xl font-bold mb-4">Courses Management</h2>

        <!-- Search and Filter Section -->
        <form action="{{ route('instructors.dashboard') }}" method="GET" class="mb-4 flex flex-col md:flex-row gap-4">
            <!-- Search Bar -->
            <div class="flex-grow">
                <input type="text" name="search" placeholder="Search courses..." value="{{ request('search') }}"
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <!-- Filter Dropdown -->
            <div>
                <select name="filter" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">All</option>
                    <option value="draft" {{ request('filter')=='draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ request('filter')=='published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ request('filter')=='archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <!-- Free Course Filter -->
            <div class="flex items-center text-lg gap-2">
                <input type="checkbox" id="is_free" name="is_free" {{ request('is_free') ? 'checked' : '' }}>
                <label for="is_free" class="text-gray-700">Is Free</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                Search
            </button>
        </form>

        <!-- Create Course Button -->
        <div class="my-6">
            <a href="{{ route('courses.create') }}"
                class="bg-blue-500 hover:bg-blue-600 px-8 py-3 rounded-md text-white text-lg font-semibold transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                Create Course
            </a>
        </div>

        <!-- Courses Table -->
        @if ($courses->isEmpty())
        <p class="text-gray-700">No courses found.</p>
        @else
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">Course Title</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Students</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr>
                    <td class="py-2 px-4 border">{{ $course->title }}</td>
                    <td class="py-2 px-4 border capitalize">{{ $course->status }}</td>
                    <td class="py-2 px-4 border">{{ $course->students_count }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('instructor.courses.content', $course) }}"
                            class="text-green-500 hover:underline">Manage Content</a> |
                        <a href="{{ route('courses.edit', $course) }}" class="text-blue-500 hover:underline">Edit</a> |
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <!-- Analytics Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Analytics</h2>
        <div class="grid grid-cols-2 gap-4">

            <!-- Students Enrolled -->
            <div class="text-center bg-gray-100 p-4 rounded-lg">
                <p class="text-3xl font-bold">{{ $courses->sum('students_count') }}</p>
                <p class="text-gray-700">Students Enrolled</p>
            </div>

            <!-- Courses Created -->
            <div class="text-center bg-gray-100 p-4 rounded-lg">
                <p class="text-3xl font-bold">{{ $courses->count() }}</p>
                <p class="text-gray-700">Courses Created</p>
            </div>

            <!-- Draft Courses -->
            <div class="text-center bg-gray-100 p-4 rounded-lg">
                <p class="text-3xl font-bold">{{ $courses->where('status', 'draft')->count() }}</p>
                <p class="text-gray-700">Draft Courses</p>
            </div>

            <!-- Published Courses -->
            <div class="text-center bg-gray-100 p-4 rounded-lg">
                <p class="text-3xl font-bold">{{ $courses->where('status', 'published')->count() }}</p>
                <p class="text-gray-700">Published Courses</p>
            </div>

            <!-- Archived Courses -->
            <div class="text-center bg-gray-100 p-4 rounded-lg">
                <p class="text-3xl font-bold">{{ $courses->where('status', 'archived')->count() }}</p>
                <p class="text-gray-700">Archived Courses</p>
            </div>

        </div>
    </div>

</div>
@endsection