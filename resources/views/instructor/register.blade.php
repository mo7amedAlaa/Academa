@extends('layouts.Layout')

@section('title', 'Academa | Register')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Create an Instructor Account</h2>

        <form method="POST" action="{{ route('instructors.store') }}" enctype="multipart/form-data"
            id="registrationForm">
            @csrf
            @method('POST')

            <div class="mb-4 relative">
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

            <div class="mb-4 relative">
                <label for="email" class="block text-gray-700">Email</label>
                <div class="flex items-center">
                    <i class="fas fa-envelope text-gray-500 mr-2"></i>
                    <input type="email" name="email" id="email" placeholder="Enter your email address"
                        class="w-full px-4 py-2 mt-2 border rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
                </div>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
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

            <div class="mb-4 relative">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <div class="flex items-center">
                    <i class="fas fa-lock text-gray-500 mr-2"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm your password" class="w-full px-4 py-2 mt-2 border rounded-lg">
                </div>
            </div>

            <div class="mb-4 relative">
                <label for="bio" class="block text-gray-700">Bio</label>
                <div class="flex items-center">
                    <i class="fas fa-pen text-gray-500 mr-2"></i>
                    <textarea name="bio" id="bio" rows="4" placeholder="Write a short bio about yourself"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                </div>
                @error('bio')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="nationality" class="block text-gray-700">Nationality</label>
                <div class="flex items-center">
                    <i class="fas fa-flag text-gray-500 mr-2"></i>
                    <input type="text" name="nationality" id="nationality" placeholder="Your nationality"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('nationality') border-red-500 @enderror"
                        value="{{ old('nationality') }}">
                </div>
                @error('nationality')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="experience_years" class="block text-gray-700">Years of Experience</label>
                <div class="flex items-center">
                    <i class="fas fa-briefcase text-gray-500 mr-2"></i>
                    <input type="number" name="experience_years" id="experience_years" placeholder="How many years?"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('experience_years') border-red-500 @enderror"
                        value="{{ old('experience_years') }}">
                </div>
                @error('experience_years')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="avatar" class="block text-gray-700">Avatar (Upload)</label>
                <div class="flex items-center">
                    <i class="fas fa-image text-gray-500 mr-2"></i>
                    <input type="file" name="avatar" id="avatar"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('avatar') border-red-500 @enderror"
                        accept=".jpg,.jpeg,.png">
                </div>
                @error('avatar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="experience_card" class="block text-gray-700">Experience Card (Upload)</label>
                <div class="flex items-center">
                    <i class="fas fa-id-card text-gray-500 mr-2"></i>
                    <input type="file" name="experience_card" id="experience_card"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('experience_card') border-red-500 @enderror">
                </div>
                @error('experience_card')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="phone" class="block text-gray-700">Phone</label>
                <div class="flex items-center">
                    <i class="fas fa-phone text-gray-500 mr-2"></i>
                    <input type="tel" name="phone" id="phone" placeholder="Enter your phone number"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('phone') border-red-500 @enderror"
                        value="{{ old('phone') }}">
                </div>
                @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="ssn" class="block text-gray-700">SSN</label>
                <div class="flex items-center">
                    <i class="fas fa-address-card text-gray-500 mr-2"></i>
                    <input type="text" name="ssn" id="ssn" placeholder="Social Security Number"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('ssn') border-red-500 @enderror"
                        value="{{ old('ssn') }}">
                </div>
                @error('ssn')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="age" class="block text-gray-700">Age</label>
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-gray-500 mr-2"></i>
                    <input type="number" name="age" id="age" placeholder="Enter your age"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('age') border-red-500 @enderror"
                        value="{{ old('age') }}">
                </div>
                @error('age')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="agree" id="agree" class="form-checkbox text-blue-500">
                <label for="agree" class="ml-2 text-gray-700">By signing up, you agree to our <a
                        href="{{ url('/terms') }}" class="text-blue-500 hover:underline">Terms of Use</a> and <a
                        href="{{ url('/privacy') }}" class="text-blue-500 hover:underline">Privacy Policy</a>.</label>
            </div>
            @error('agree')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <div class="mt-6 relative">
                <button type="submit" id="submitButton"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Register
                </button>
                <div id="loadingSpinner"
                    class="absolute inset-0 flex justify-center items-center bg-white opacity-75 hidden">
                    <div class="w-8 h-8 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
                </div>

            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Already have an account? Login</a>
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