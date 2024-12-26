@extends('layouts.Layout')

@section('title', $course->name)

@section('content')
<div class="container mx-auto my-5 min-h-screen">
    <h1 class="text-center text-3xl font-bold mb-4">{{ $course->name }}</h1>

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

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="col-span-1">
            <h3 class="text-xl font-semibold mb-3 flex items-center">
                <i class="fas fa-chalkboard-teacher mr-2"></i> Lessons
            </h3>
            @if($course->lessons->isEmpty())
            <div class="alert alert-info p-3 bg-blue-100 text-blue-800 rounded-lg">
                <i class="fas fa-info-circle mr-2"></i> No lessons available for this course yet.
            </div>
            @else
            <ul class="space-y-2">
                @foreach($course->lessons()->orderBy('position')->get() as $lesson)
                <li>
                    <a href="javascript:void(0)" class="lesson-link text-blue-500 hover:text-blue-700 flex items-center"
                        data-lesson-id="{{ $lesson->id }}" data-course-id="{{ $course->id }}"
                        data-lesson="{{ json_encode($lesson) }}">
                        <i class="fas fa-book mr-2"></i> {{ $lesson->title }}
                        @if($lesson->status->first()?->status)
                        <i class="fas fa-check-circle text-green-500 ml-2"></i>
                        @else
                        <i class="fas fa-times-circle text-red-500 ml-2"></i>
                        @endif

                        @if($lesson->content_type == 'quiz')
                        @if($lesson->quiz && $lesson->quiz->score->where('user_id', auth()->id())->first())
                        <span class="text-sm text-green-500">({{ $lesson->quiz->score->where('user_id',
                            auth()->id())->first()->score
                            }}%)</span>
                        @endif


                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <div class="col-span-3">
            <h3 class="text-2xl font-semibold mt-5">
                <i class="fas fa-info-circle mr-2"></i> Course Description
            </h3>
            <p>{{ $course->description }}</p>

            <h3 class="mt-5 text-xl font-semibold">
                <i class="fas fa-file-alt mr-2"></i> Lesson Content
            </h3>
            <div id="lesson-content" class="lesson-content hidden items-center justify-center h-[600px] bg-gray-100">
                <!-- Content will be dynamically added here -->
            </div>
        </div>
    </div>
</div>

<div class="mt-6 md:flex md:justify-between">
    <div class="w-full  ">
        <h3 class="text-xl font-semibold mb-3 flex items-center">
            <i class="fas fa-tasks mr-2"></i> Course Progress
        </h3>
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

        <a href="{{ route('my-learning') }}"
            class="mt-3 text-center  bg-blue-500 text-white py-2 px-2 rounded-lg flex justify-center items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Courses
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lessonLinks = document.querySelectorAll('.lesson-link');
        const lessonContent = document.getElementById('lesson-content');

        function loadLessonContent(lessonData) {
            lessonContent.innerHTML = '';
            lessonContent.classList.remove('hidden');

            let contentHTML = `<h5 class="text-lg font-semibold">${lessonData.title}</h5>`;

            if (lessonData.content_type === 'video') {
                contentHTML += `<div class="h-full w-full overflow-hidden">
                <video class="w-full h-full object-cover" controls>
                    <source src="{{ asset('${lessonData.media}') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>`;
            } else if (lessonData.content_type === 'image') {
                contentHTML += `<div class="h-full w-full overflow-hidden">
                <img src="{{ asset('${lessonData.media}')}}" alt="${lessonData.title}" class="w-full h-full object-contain rounded-lg">
            </div>`;
            } else if (lessonData.content_type === 'pdf') {
                contentHTML += `<div class="h-full w-full overflow-hidden">
                <a href="{{ asset('${lessonData.media}') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg" target="_blank">
                    <i class="fas fa-file-pdf mr-2"></i> Download PDF
                </a>
            </div>`;
            } else if (lessonData.content_type === 'quiz') {
                const quizUrl = `/student/quiz/start/${lessonData.id}`;
                contentHTML += `<div class="h-full w-full overflow-hidden flex items-center justify-center">
                <a href="${quizUrl}" class="bg-green-500 text-white py-2 px-4 rounded-lg">
                    <i class="fas fa-play-circle mr-2"></i> Start Quiz
                </a>
            </div>`;
            } else if (lessonData.content_type === 'link') {
                contentHTML += `<div class="h-full w-full overflow-hidden flex items-center justify-center">
                <a href="${lessonData.link}" class="bg-green-500 text-white py-2 px-4 rounded-lg">
                    <i class="fas fa-external-link-alt mr-2"></i> Go to Link
                </a>
            </div>`;
            } else {
                contentHTML += `<p class="text-center">No content available for this lesson.</p>`;
            }

            const lessonCompleteUrl = '{{ route("lesson.complete", ["lesson_id" => "__lesson_id__"]) }}'.replace('__lesson_id__', lessonData.id);
            contentHTML += `<p>${lessonData.notes ? lessonData.notes : 'No Notes for this lesson'}</p>`;
            contentHTML += `<a href="${lessonCompleteUrl}" class="mark-complete-btn bg-blue-500 text-white py-2 px-4 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i> Mark as Complete
            </a>`;

            lessonContent.innerHTML = contentHTML;
        }

        lessonLinks.forEach(link => {
            link.addEventListener('click', function () {
                const lessonData = JSON.parse(this.getAttribute('data-lesson'));
                const courseId = this.getAttribute('data-course-id');
                loadLessonContent(lessonData);

                sessionStorage.setItem('selectedLesson_' + courseId, JSON.stringify(lessonData));
            });
        });

        const courseId = "{{ $course->id }}";

        const selectedLesson = sessionStorage.getItem('selectedLesson_' + courseId);
        if (selectedLesson) {
            const lessonData = JSON.parse(selectedLesson);
            loadLessonContent(lessonData);
        } else if (lessonLinks.length > 0) {
            const firstLessonData = JSON.parse(lessonLinks[0].getAttribute('data-lesson'));
            loadLessonContent(firstLessonData);
        }
    });
</script>

<style>
    .lesson-content {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        height: 700px;
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        overflow: hidden;
    }

    .lesson-content img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .lesson-content video {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .lesson-content a {
        margin-top: 15px;
        padding: 10px 20px;
        display: inline-block;
        background-color: #2D9CDB;
        color: white;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .lesson-content a:hover {
        background-color: #1C6D9A;
    }

    .lesson-content p {
        font-size: 1.1rem;
        margin-top: 15px;
        text-align: center;
    }

    .lesson-content .flex.items-center.justify-center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .mark-complete-btn {
        margin-top: auto;
        align-self: flex-end;
    }
</style>
@endsection