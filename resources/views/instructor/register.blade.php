@extends('layouts.Layout')

@section('title', 'academa|Register')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Create an Instructor Account</h2>

        <form method="POST" action="{{ route('instructors.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name"
                    class="w-full px-4 py-2 mt-2 border rounded-lg @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 mt-2 border rounded-lg @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 mt-2 border rounded-lg @error('password') border-red-500 @enderror">
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 mt-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-gray-700">Bio</label>
                <textarea name="bio" id="bio" rows="4"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                @error('bio')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nationality" class="block text-gray-700">Nationality</label>
                <input type="text" name="nationality" id="nationality"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('nationality') border-red-500 @enderror"
                    value="{{ old('nationality') }}">
                @error('nationality')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="experience_years" class="block text-gray-700">Years of Experience</label>
                <input type="number" name="experience_years" id="experience_years"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('experience_years') border-red-500 @enderror"
                    value="{{ old('experience_years') }}">
                @error('experience_years')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="avatar" class="block text-gray-700">Avatar (Upload)</label>
                <input type="file" name="avatar" id="avatar"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('avatar') border-red-500 @enderror"
                    accept=".jpg,.jpeg,.png">
                @error('avatar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="experience_card" class="block text-gray-700">Experience Card (Upload)</label>
                <input type="file" name="experience_card" id="experience_card"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('experience_card') border-red-500 @enderror">
                @error('experience_card')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone</label>
                <input type="tel" name="phone" id="phone"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('phone') border-red-500 @enderror"
                    value="{{ old('phone') }}">
                @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="ssn" class="block text-gray-700">SSN</label>
                <input type="text" name="ssn" id="ssn"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('ssn') border-red-500 @enderror"
                    value="{{ old('ssn') }}">
                @error('ssn')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="age" class="block text-gray-700">Age</label>
                <input type="number" name="age" id="age"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('age') border-red-500 @enderror"
                    value="{{ old('age') }}">
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

            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                    Register
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Already have an account? Login</a>
        </div>
    </div>
</div>
@endsection