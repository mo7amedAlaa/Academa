@extends('layouts.welcomeLayout')

@section('title', 'academa|Register')

@section('content')


<div class="flex justify-center items-center min-h-screen">
    <div class="hidden lg:block p-8 w-full ">
        <img src="{{ asset('images/reg.webp') }}" alt="Academa Logo" class="  w-full h-full ">
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg  w-full">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Login to Your Account</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            @method('POST')
            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 mt-2 border rounded-lg @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 mt-2 border rounded-lg @error('password') border-red-500 @enderror">
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="form-checkbox text-blue-500">
                <label for="remember" class="ml-2 text-gray-700">Remember me</label>
            </div>

            <div class="mt-6">
                <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                    Login
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Don't have an account? Register</a>
        </div>
    </div>
</div>
@endsection
