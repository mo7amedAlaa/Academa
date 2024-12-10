<div class="relative w-full max-h-4xl mx-auto mb-10">
    <div class="relative overflow-hidden rounded-lg shadow-lg">
        <div id="slider" class="flex transition-all duration-700 ease-in-out h-96">
            @foreach ($images as $image)
            <div class="w-full flex-shrink-0 relative">
                <img src="{{ asset('/images/' . $image) }}" alt="Slider Image" class="w-full h-full object-cover">
                <div class="absolute top-10 left-10 w-auto p-4 z-10 bg-white rounded-lg shadow-lg text-black text-left">
                    <i class="fas fa-lightbulb text-4xl mb-4"></i>
                    <h3 class="text-2xl font-semibold mb-2">Craving some flexibility?</h3>
                    <p class="text-base">Explore thousands of highly-rated courses with Personal Plan.</p>
                </div>
            </div>
            @endforeach
        </div>
        <button id="prev"
            class="absolute left-0 top-1/2 transform -translate-y-1/2 text-white bg-black bg-opacity-50 p-3 rounded-full hover:bg-opacity-75">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="next"
            class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white bg-black bg-opacity-50 p-3 rounded-full hover:bg-opacity-75">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>