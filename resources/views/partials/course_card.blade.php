@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div
    class="flex-shrink-0 w-72 h-auto bg-white shadow-xl rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105 relative group">
    <img src="{{ asset($course->cover_image) }}" alt="{{ $course->title }}"
        class="w-full h-48 object-cover rounded-t-lg">

    <!-- Discount Banner -->
    @if($course->discount > 0)
    <div class="absolute top-2 left-2 bg-red-500 text-white py-1 px-3 text-xs font-semibold rounded-full">
        {{number_format($course->discount)}}% Discount
    </div>
    @endif

    <div
        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-5">
        <div class="text-center text-white">
            <h3 class="text-2xl font-semibold mb-2">{{ $course->title }}</h3>
            <p class="text-base mb-3">{{ Str::limit($course->description, 60) }}</p>
            <div class="flex justify-center space-x-4">
                <form action="{{route('courses.show', $course->id)}}" method="get">
                    @csrf
                    @method('GET')
                    <button type="submit" title="Show Details" class="text-4xl text-yellow-500 hover:text-yellow-700">
                        <i class="fa-solid fa-circle-info"></i> </button>
                </form>
                @if(auth()->user()?->hasRole('student'))
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <input type="hidden" name="name" value="{{ $course->title }}">
                    <input type="hidden" name="price"
                        value="{{ $course->price - ($course->price * $course->discount) / 100 }}">
                    <input type="hidden" name="cover_image" value="{{ $course->cover_image ?? 'default_value' }}">
                    <button type="submit" title="Add to Cart" class="text-4xl text-blue-500 hover:text-blue-700 z-20">
                        <i class="fas fa-cart-plus"></i>
                    </button>
                </form>


                <form action="{{route('favorites.add')}}" method="post">
                    @csrf
                    @method('post')
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="student_id" value="{{ $user?->student?->id }}">

                    <button type="submit" title="Add to favorites" class="text-4xl text-red-500 hover:text-red-700">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <div class="p-5">
        <h3 class="text-xl font-semibold mb-2 text-gray-800 truncate" title="{{ $course->title }}">
            {{ $course->title }}
        </h3>
        <p class="text-gray-600 text-sm mb-2">Instructor: <span class="font-medium">{{ $course->instructor->user->name
                }}</span></p>

        <div class="flex items-center mb-3">
            <div class="flex items-center text-yellow-400 mr-2">
                @include('partials.rating', ['rating' => $course->reviews->avg('rating') ?? 0])
            </div>

            @if($course->discount > 0)
            <span class="text-lg font-semibold text-red-500 line-through mr-2">
                ${{ number_format($course->price, 2) }}
            </span>
            <span class="text-lg font-semibold text-green-600">
                ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
            </span>
            @else
            <span class="text-lg font-semibold text-gray-900">
                ${{ number_format($course->price, 2) }}
            </span>
            @endif
        </div>

        <p class="text-sm text-gray-500">{{ $course->reviews->count() }} Reviews</p>
    </div>
</div>