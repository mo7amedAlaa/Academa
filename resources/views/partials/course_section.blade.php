<div class="mb-8 md:mb-12">
    <h2
        class="text-3xl md:text-4xl font-semibold mb-4 md:mb-6 text-indigo-700 flex items-center justify-start transition-all duration-300 transform hover:scale-105">
        <i
            class="fas fa-info-circle text-xl md:text-2xl mr-3 text-indigo-700 transition-all duration-300 transform hover:text-indigo-600"></i>
        {{ $title }}
    </h2>
    <p
        class="text-base md:text-lg mb-6 md:mb-8 text-gray-700 justify-start flex items-center transition-all duration-300 transform hover:scale-105">
        <i
            class="fas fa-quote-left text-sm md:text-2xl mr-3 text-gray-600 transition-all duration-300 transform hover:text-gray-500"></i>
        {{ $description }}
    </p>
    <div class="relative w-full mx-auto">
        <div class="flex space-x-4 md:space-x-8 overflow-x-auto no-scrollbar p-4 md:p-5">
            @foreach ($courses as $course)
            @include('partials.course_card', $course)
            @endforeach
        </div>
    </div>
</div>