@extends('layouts.welcomeLayout')

@section('title', 'academa|Register')

@section('content')
<div class="flex justify-center   items-center min-h-screen ">
    <div class="hidden lg:block p-8 w-full ">
        <img src="{{ asset('images/reg.webp') }}" alt="Academa Logo" class="  w-full h-full ">
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg  w-full ">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Create an Account</h2>

        <form method="POST" action="{{route('store')}}" enctype="multipart/form-data">
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
                <label for="avatar" class="block text-gray-700">Avatar (Upload)</label>

                <input type="file" name="avatar" id="avatar"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 @error('avatar') border-red-500 @enderror" />
                @error('avatar')
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

            <!-- Terms and Privacy Policy Agreement -->
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