<div class="mb-12">
    <h2 class="text-4xl font-semibold mb-6 text-indigo-700">{{ $title }}</h2>
    <p class="text-lg mb-8 text-gray-700">{{ $description }}</p>
    <div class="relative w-full mx-auto">
        <div class="flex space-x-8 overflow-x-auto no-scrollbar p-5">
            @foreach ($courses as $course)
            @include('partials.course_card', $course)
            @endforeach
        </div>
    </div>
</div>