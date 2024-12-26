@extends('layouts.welcomeLayout')

@section('content')
<div class="min-h-screen  container flex items-center justify-center">
    <div class=" w-full mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Reset Your Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('email', $email) }}" required>
                @error('email')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @error('password')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @error('password_confirmation')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Reset
                Password</button>
        </form>
    </div>
</div>

@endsection