@extends('layouts.Layout')

@section('title', $course->name)

@section('content')
<div class="container mx-auto my-5 min-h-screen">
    <h1 class="text-center text-3xl font-bold mb-4">{{ $course->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar with Lessons -->
        <div class="col-span-1">
            <h3 class="text-xl font-semibold mb-3">Lessons</h3>
            @if($course->lessons->isEmpty())
            <div class="alert alert-info p-3 bg-blue-100 text-blue-800 rounded-lg">
                No lessons available for this course yet.
            </div>
            @else
            <ul class="space-y-2">
                @foreach($course->lessons as $lesson)
                <li>
                    <a href="javascript:void(0)" class="lesson-link text-blue-500 hover:text-blue-700"
                        data-lesson-id="{{ $lesson->id }}">
                        {{ $lesson->title }}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- Content or Media Area (Second Column) -->
        <div class="col-span-3">
            <h3 class="text-2xl font-semibold mt-5">Course Description</h3>
            <p>{{ $course->description }}</p>

            <h3 class="mt-5 text-xl font-semibold">Lesson Content</h3>
            <!-- Fixed space for the lesson content -->
            <div id="lesson-content" class="lesson-content h-[500px] w-full bg-gray-100   hidden">
                <!-- Content will be dynamically added here -->
            </div>

        </div>
    </div>
</div>

<!-- Course Progress and Return Button -->
<div class="mt-6 md:flex md:justify-between">
    <!-- Course Progress Sidebar -->
    <div class="w-full md:w-1/4">
        <h3 class="text-xl font-semibold mb-3">Course Progress</h3>
        <div class="relative pt-1">
            <div class="flex mb-2 items-center justify-between">
                <div>
                    <span class="font-semibold">{{ $course->pivot->progress_percentage }}%</span>
                </div>
            </div>
            <div class="progress">
                <div class="bg-green-300 h-3 rounded-lg" role="progressbar"
                    style="width: {{ $course->pivot->progress_percentage }}%;"
                    aria-valuenow="{{ $course->pivot->progress_percentage }}" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>

        <a href="{{ route('my-learning') }}" class="mt-3 inline-block bg-blue-500 text-white py-2 px-4 rounded-lg">
            Back to Courses
        </a>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lessonLinks = document.querySelectorAll('.lesson-link');

        lessonLinks.forEach(link => {
            link.addEventListener('click', function () {
                const lessonId = this.getAttribute('data-lesson-id');
                const lessonContent = document.getElementById('lesson-content');

                // Close previous content
                lessonContent.innerHTML = '';
                lessonContent.classList.remove('hidden');

                // Get lesson content (you can also use AJAX here to dynamically load the content)
                const lesson = @json($course -> lessons -> toArray()).find(lesson => lesson.id == lessonId);

                // Generate content based on lesson type
                let contentHTML = `<h5 class="text-lg font-semibold">${lesson.title}</h5>`;
                contentHTML += `<p>${lesson.content}</p>`;

                if (lesson.content_type === 'video') {
                    contentHTML += `<div class="h-full w-full">
                        <video class="w-full h-full object-cover" controls>
                            <source src="{{ asset('${lesson.media}') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>`;
                } else if (lesson.content_type === 'image') {
                    contentHTML += `<div class="h-full w-full">
                        <img src="{{ asset('${lesson.media}')}}" alt="${lesson.title}" class="w-full h-full object-cover rounded-lg">
                    </div>`;
                } else if (lesson.content_type === 'pdf') {
                    contentHTML += `<div class="h-full w-full">
                        <a href="{{ asset('${lesson.media}') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg" target="_blank">Download PDF</a>
                    </div>`;
                } else if (lesson.content_type === 'quiz') {
                    contentHTML += `<div class="h-full w-full">
                        <a href="{{ asset('${lesson.link}') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg">Start Quiz</a>
                    </div>`;
                }

                lessonContent.innerHTML = contentHTML;
            });
        });
    });
</script>

@endsection