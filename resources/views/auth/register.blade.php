@extends('layouts.welcomeLayout')

@section('title', 'Academa | Register')

@section('content')
<div class="flex flex-col lg:flex-row justify-center items-center min-h-screen p-4">
    <!-- Left Image Section for larger screens -->
    <div class="hidden lg:block lg:w-1/2 p-8">
        <img src="{{ asset('images/reg.webp') }}" alt="Academa Logo"
            class="w-full h-full object-cover rounded-lg shadow-md">
    </div>

    <!-- Right Form Section -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-full lg:w-1/3">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Create an Account</h2>

        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" id="registrationForm">
            @csrf
            @method('POST')

            <!-- Name Input -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <div class="flex items-center">
                    <i class="fas fa-user text-gray-500 mr-2"></i>
                    <input type="text" name="name" id="name" placeholder="Enter your full name"
                        class="w-full px-4 py-2 mt-2 border rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}">
                </div>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <div class="flex items-center">
                    <i class="fas fa-envelope text-gray-500 mr-2"></i>
                    <input type="email" name="email" id="email" placeholder="Enter your email"
                        class="w-full px-4 py-2 mt-2 border rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
                </div>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Avatar Input -->
            <div class="mb-4">
                <label for="avatar" class="block text-gray-700">Avatar (Upload)</label>
                <div class="flex items-center">
                    <i class="fas fa-image text-gray-500 mr-2"></i>
                    <input type="file" name="avatar" id="avatar"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('avatar') border-red-500 @enderror">
                </div>
                @error('avatar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <div class="flex items-center">
                    <i class="fas fa-lock text-gray-500 mr-2"></i>
                    <input type="password" name="password" id="password" placeholder="Create a password"
                        class="w-full px-4 py-2 mt-2 border rounded-lg @error('password') border-red-500 @enderror">
                </div>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password Input -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <div class="flex items-center">
                    <i class="fas fa-lock text-gray-500 mr-2"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm your password" class="w-full px-4 py-2 mt-2 border rounded-lg">
                </div>
            </div>

            <!-- Terms Agreement -->
            <div class="mb-4 flex items-center text-sm">
                <input type="checkbox" name="agree" id="agree" class="form-checkbox text-blue-500">
                <label for="agree" class="ml-2 text-gray-700">By signing up, you agree to our <a
                        href="{{ url('/terms') }}" class="text-blue-500 hover:underline">Terms of Use</a> and <a
                        href="{{ url('/privacy') }}" class="text-blue-500 hover:underline">Privacy Policy</a>.</label>
            </div>
            @error('agree')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <!-- Submit Button with Loading Spinner -->
            <div class="mt-6 relative">
                <button type="submit" id="submitButton"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none transition duration-300">
                    Register
                </button>
                <div id="loadingSpinner"
                    class="absolute inset-0 flex justify-center items-center bg-white opacity-75 hidden">
                    <div class="w-8 h-8 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
                </div>
            </div>
        </form>

        <!-- Login Link -->
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline text-sm">Already have an account?
                Login</a>
        </div>
    </div>
</div>


<script>
    document.getElementById('registrationForm').addEventListener('submit', function () {
        document.getElementById('submitButton').disabled = true;
        document.getElementById('loadingSpinner').classList.remove('hidden');
    });
</script>


@endsection