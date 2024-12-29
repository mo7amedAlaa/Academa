@extends('layouts.Layout')

@section('title', 'Instructor Dashboard')

@section('content')
<div class="min-h-screen px-4 sm:px-6 lg:px-8">
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div
            class="col-span-1 lg:col-span-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl sm:text-4xl font-bold flex items-center gap-2">
                <i class="fas fa-chalkboard-teacher"></i>
                Welcome, {{ $user->name }}!
            </h1>
            <p class="text-lg mt-2">Here's an overview of your instructor activities.</p>
        </div>

        <!-- Courses Management Section - Full Width -->
        <div class="bg-white rounded-lg shadow-md p-6 col-span-1 lg:col-span-3">
            <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                <i class="fas fa-book"></i> Courses Management
            </h2>

            <form action="{{ route('instructors.dashboard') }}" method="GET"
                class="mb-4 flex flex-col md:flex-row gap-4">
                <div class="flex-grow">
                    <input type="text" name="search" placeholder="Search courses..." value="{{ request('search') }}"
                        class="w-full p-2 border border-gray-300 rounded-lg text-sm sm:text-base">
                </div>

                <div>
                    <select name="filter" class="w-full p-2 border border-gray-300 rounded-lg text-sm sm:text-base">
                        <option value="">All</option>
                        <option value="draft" {{ request('filter')=='draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('filter')=='published' ? 'selected' : '' }}>Published
                        </option>
                        <option value="archived" {{ request('filter')=='archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <div class="flex items-center text-lg gap-2">
                    <input type="checkbox" id="is_free" name="is_free" {{ request('is_free') ? 'checked' : '' }}
                        class="h-5 w-5">
                    <label for="is_free" class="text-sm sm:text-base">Is Free</label>
                </div>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mt-2 sm:mt-0 text-sm sm:text-base flex items-center gap-2">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>

            <div class="my-6">
                <a href="{{ route('courses.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-md text-white text-sm sm:text-lg font-semibold transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i> Create Course
                </a>
            </div>

            <!-- Courses Table -->
            @if ($courses->isEmpty())
            <p class="text-gray-700">No courses found.</p>
            @else
            <div class="overflow-x-auto max-h-80">
                <table class="w-full table-auto border-collapse border border-gray-200 rounded-lg">
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
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border">{{ $course->title }}</td>
                            <td class="py-2 px-4 border capitalize">{{ $course->status }}</td>
                            <td class="py-2 px-4 border">{{ $course->students_count }}</td>
                            <td class="py-2 px-4 border flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0">
                                <a href="{{ route('instructor.courses.content', $course) }}"
                                    class="flex items-center gap-2">
                                    <button
                                        class="bg-green-100 hover:bg-green-200 px-4 py-2 rounded-lg text-sm sm:text-base font-semibold focus:outline-none focus:ring-2 focus:ring-green-300 w-full sm:w-auto flex items-center gap-2">
                                        <i class="fas fa-tasks"></i> Manage Content
                                    </button>
                                </a>

                                <a href="{{ route('courses.edit', $course) }}" class="flex items-center gap-2">
                                    <button
                                        class="bg-blue-100 hover:bg-blue-200 px-4 py-2 rounded-lg text-sm sm:text-base font-semibold focus:outline-none focus:ring-2 focus:ring-blue-300 w-full sm:w-auto flex items-center gap-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </a>

                                <form action="{{ route('courses.destroy', $course) }}" method="POST"
                                    class="flex items-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-100 hover:bg-red-200 px-4 py-2 rounded-lg text-sm sm:text-base font-semibold focus:outline-none focus:ring-2 focus:ring-red-300 w-full sm:w-auto flex items-center gap-2">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        <!-- Rating and Analytics Section in One Row -->
        <div class="col-span-1 lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Rating Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
                    <i class="fas fa-star"></i> Instructor Rating
                </h2>
                <div class="text-center bg-gray-100 p-6 rounded-lg sm:flex sm:items-center sm:justify-between">
                    <div class="sm:flex sm:items-center sm:space-x-4">
                        <p
                            class="text-5xl font-extrabold text-yellow-500 flex items-center justify-center sm:justify-start">
                            <span>{{ number_format($instructor->averageRating(),1) }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-400 ml-2"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27l5.18 3.73-1.64-6.81 5.18-4.52-6.88-.58L12 2 9.16 9.09l-6.88.58 5.18 4.52-1.64 6.81L12 17.27z" />
                            </svg>
                        </p>
                        <p class="text-gray-700 text-base mt-2 sm:mt-0">
                            Based on <span class="font-medium">{{ $instructor->total_reviews }}</span>
                            {{ Str::plural('review', $instructor->total_reviews) }}
                        </p>
                    </div>
                </div>
                <div class="mt-4 ">
                    <a href="{{route('instructor.review', $instructor->id)}}"
                        class="bg-yellow-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-yellow-600 transition duration-300">
                        View Detailed Ratings
                    </a>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-bar"></i> Analytics
                </h2>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div class="text-center bg-gray-100 p-4 rounded-lg">
                        <p class="text-3xl font-bold">{{ $courses->sum('students_count') }}</p>
                        <p class="text-gray-700 text-sm sm:text-base">Students Enrolled</p>
                    </div>
                    <div class="text-center bg-gray-100 p-4 rounded-lg">
                        <p class="text-3xl font-bold">{{ $courses->count() }}</p>
                        <p class="text-gray-700 text-sm sm:text-base">Courses Created</p>
                    </div>
                    <div class="text-center bg-gray-100 p-4 rounded-lg">
                        <p class="text-3xl font-bold">{{ $courses->where('status', 'draft')->count() }}</p>
                        <p class="text-gray-700 text-sm sm:text-base">Draft Courses</p>
                    </div>
                    <div class="text-center bg-gray-100 p-4 rounded-lg">
                        <p class="text-3xl font-bold">{{ $courses->where('status', 'published')->count() }}</p>
                        <p class="text-gray-700 text-sm sm:text-base">Published Courses</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection