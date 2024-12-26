@extends('layouts.Layout')

@section('title', $settings['site_name'] . ' | student')

@section('content')
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
<div class="flex flex-col">
    @auth
    <div class="flex items-center bg-gradient-to-r from-indigo-500 to-indigo-700 p-8 rounded-lg shadow-xl mb-8 w-full">
        <i class="fas fa-user-circle text-6xl text-white mr-6"></i>
        <div class="text-white">
            <h1 class="text-4xl font-extrabold mb-2">Welcome Back, {{ $user->name }}!</h1>
            <p class="text-lg">It's great to see you again. We hope you're having a productive day.</p>
            @if(!$user->student->interests_field)
            <a href="{{ route('personalize') }}"
                class="bg-indigo-500 inline-block mt-5 text-white hover:bg-indigo-600 py-2 px-6 rounded-lg text-lg font-semibold capitalize">
                Add Your Interests Field
            </a>
            @endif
        </div>
    </div>
    @endauth

    @include('partials.slider', ['images' => ['slider1.jpg', 'slider2.jpg', 'slider3.jpg']])

    <div class="my-12 px-6">
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

    @if($user->student->interests_field)


    <div class="my-12 px-6">
        <h1 class="text-4xl font-semibold mb-6 text-indigo-700">Top Courses Based on Your Interest: "<span
                class="text-green-500">
                {{ $category->name }}
            </span>"
        </h1>
        <p class="text-lg mb-6">Explore the best courses in your chosen field. Here are some of the most popular
            courses that match your interests.</p>
        <div class="flex space-x-8 overflow-x-auto no-scrollbar p-5">
            @foreach ($interCourses as $course)
            @include('partials.course_card', ['course' => $course])
            @endforeach
        </div>
    </div>


    <div class="my-5">
        <h1 class="text-4xl font-semibold mb-6 text-indigo-700">Recommended Topics for You</h1>
        <p class="text-lg mb-6">Based on your interest in "<span class="text-green-500">
                {{ $category->name }}
            </span>", we have picked the most relevant
            topics
            for you.</p>
        <div class="flex flex-wrap  ">
            @foreach ($recommendedTopics as $topic)
            <div class="p-5 w-full sm:w-1/2 lg:w-1/3 text-center text-black text-lg font-bold tracking-widest">
                <a href="{{ route('categories.courses', $topic->id) }}"
                    class="w-full h-full bg-gray-100 hover:bg-gray-300 hover:text-black/50 transform hover:-translate-y-1 duration-300 p-6 rounded-lg shadow-md inline-block">
                    {{ $topic->name }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <!-- Prompt to Add Interests Field -->
    <div class="my-12 px-6 bg-gray-100 p-8 rounded-lg shadow-lg text-center">
        <h2 class="text-2xl font-semibold mb-4">Personalize Your Experience</h2>
        <p class="text-lg mb-6">To receive personalized course and topic recommendations, please set your interest
            field.
        </p>
        <a href="{{ route('personalize') }}"
            class="bg-indigo-500 text-white hover:bg-indigo-600 py-2 px-6 rounded-lg text-lg font-semibold capitalize">
            Add Your Interests Field
        </a>
    </div>
    @endif

</div>

<script>
    const prev = document.getElementById('prev');
    const next = document.getElementById('next');
    const slider = document.getElementById('slider');

    let currentSlide = 0;
    const slides = slider.children.length;
    const slideWidth = slider.offsetWidth;

    function moveSlider() {
        slider.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    }

    prev.addEventListener('click', () => {
        currentSlide = currentSlide === 0 ? slides - 1 : currentSlide - 1;
        moveSlider();
    });

    next.addEventListener('click', () => {
        currentSlide = currentSlide === slides - 1 ? 0 : currentSlide + 1;
        moveSlider();
    });
</script>
@endsection