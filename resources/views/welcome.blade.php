@extends('layouts.welcomeLayout')

@section('title', $settings['site_name'] . ' | Welcome')

@section('content')
<div class="flex flex-col">
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

    @auth
    <div
        class="flex items-center bg-gradient-to-r from-indigo-500 to-indigo-700 p-6 md:p-8 rounded-lg shadow-xl mb-8 w-full">
        <i class="fas fa-user-circle text-4xl md:text-6xl text-white mr-4 md:mr-6"></i>
        <div class="text-white">
            <h1 class="text-2xl md:text-4xl font-extrabold mb-2">Welcome Back, {{ $user->name }}!</h1>
            <p class="text-base md:text-lg">It's great to see you again. We hope you're having a productive day.</p>

            @if(auth()->user()->hasRole('student'))
            <a href="{{ route('student.dashboard') }}"
                class="bg-indigo-500 inline-block mt-4 md:mt-5 text-white hover:bg-indigo-600 py-2 px-6 rounded-lg text-sm md:text-lg font-semibold capitalize">Go
                to your Dashboard</a>
            @elseif(auth()->user()->hasRole('instructor'))
            <a href="{{ route('instructors.dashboard') }}"
                class="bg-indigo-500 inline-block mt-4 md:mt-5 text-white hover:bg-indigo-600 py-2 px-6 rounded-lg text-sm md:text-lg font-semibold capitalize">Go
                to your Dashboard</a>
            @endif
        </div>
    </div>
    @else
    <div
        class="flex items-center bg-gradient-to-r from-green-500 to-green-700 p-6 md:p-8 rounded-lg shadow-xl mb-8 w-full">
        <i class="fas fa-university text-4xl md:text-6xl text-white mr-4 md:mr-6"></i>
        <div class="text-white">
            <h1 class="text-2xl md:text-4xl font-extrabold mb-2">Welcome to Academa</h1>
            <p class="text-base md:text-lg">Join thousands of learners and instructors on their journey to success.</p>
            <a href="{{ route('register') }}"
                class="bg-green-500 inline-block mt-4 md:mt-5 text-white hover:bg-green-600 py-2 px-6 rounded-lg text-sm md:text-lg font-semibold capitalize">
                Get Started
            </a>
        </div>
    </div>
    <div
        class="flex items-center bg-gradient-to-r from-blue-500 to-blue-700 p-6 md:p-8 rounded-lg shadow-xl mb-8 w-full">
        <i class="fas fa-book-reader text-4xl md:text-6xl text-white mr-4 md:mr-6"></i>
        <div class="text-white">
            <h1 class="text-2xl md:text-4xl font-extrabold mb-2">Learn Online with Academa</h1>
            <p class="text-base md:text-lg">Discover new courses, expand your knowledge, and reach your goals.</p>
            <a href="{{ route('login') }}"
                class="bg-blue-500 inline-block mt-4 md:mt-5 text-white hover:bg-blue-600 py-2 px-6 rounded-lg text-sm md:text-lg font-semibold capitalize">
                Sign In
            </a>
        </div>
    </div>
    @endauth

    <div class="my-8 md:my-12 px-4 md:px-6">
        @foreach ([
        ['title' => 'Top Rated Courses', 'description' => 'These courses are highly rated by students like you!',
        'courses' => $topRatedCourses],
        ['title' => 'Recently Added Courses', 'description' => 'Check out our newest courses, freshly added for you.',
        'courses' => $recentlyAddedCourses],
        ['title' => 'Popular Courses', 'description' => 'Check out our popular courses, freshly updated for you.',
        'courses' => $popularCourses],
        ] as $section)
        @include('partials.course_section', $section)
        @endforeach
    </div>
</div>
@endsection