@extends('layouts.Layout')

@section('title', 'Academa | Favorites')

@section('content')
<div class="container mx-auto py-12 px-2 md:px-4 min-h-screen">
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

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="flex items-center mb-6">
        <i class="fas fa-heart text-4xl text-indigo-700 mr-3"></i>
        <h2 class="text-4xl font-semibold text-indigo-700">Your Favorite Courses</h2>
    </div>

    <p class="text-lg mb-8 text-gray-700">Courses you have added to your favorites!</p>

    @if(!$favorites || $favorites->isEmpty())
    <div class="text-center bg-gray-100 p-6 rounded-lg shadow-md ">
        <p class="text-gray-700 text-lg mb-4">No favorite courses found!</p>
        <a href="{{ route('welcome') }}"
            class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">
            Browse Courses
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($favorites as $favorite)
        @if($favorite)
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <img src="{{ asset($favorite->cover_image ?? 'default-image.jpg') }}" alt="{{ $favorite->title }}"
                class="w-full h-48 object-cover">

            <div class="p-5">
                <h3 class="text-xl font-semibold mb-2 text-gray-800 truncate" title="{{ $favorite->title }}">
                    {{ $favorite->title }}
                </h3>
                <p class="text-gray-600 text-sm mb-2">Instructor: <span class="font-medium">{{
                        $favorite->instructor?->user->name }}</span></p>
                <span class="text-lg font-semibold text-gray-900">${{ $favorite->price }}</span>

                <div class="mt-4 flex flex-col space-y-4">
                    <form action="{{ route('favorites.remove') }}" method="post" class="w-full">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="course_id" value="{{ $favorite->id }}">
                        <input type="hidden" name="student_id" value="{{ auth()->user()->student->id }}">

                        @error('course_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        @error('student_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                            class="flex items-center justify-center w-full bg-red-600 text-white py-3 px-4 rounded-lg hover:bg-red-700 focus:outline-none transition duration-300 ease-in-out text-center">
                            <i class="fas fa-heart-broken mr-2"></i> Remove from Favorites
                        </button>
                    </form>

                    <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="id" value="{{ $favorite->id }}">
                        <input type="hidden" name="name" value="{{ $favorite->title }}">
                        <input type="hidden" name="price" value="{{ $favorite->price }}">
                        <input type="hidden" name="cover_image"
                            value="{{ $favorite->cover_image ? $favorite->cover_image : 'default_value' }}">
                        <input type="hidden" name="quantity" value="1">

                        <button type="submit"
                            class="flex items-center justify-center w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none transition duration-300 ease-in-out text-center">
                            <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endif
</div>
@endsection