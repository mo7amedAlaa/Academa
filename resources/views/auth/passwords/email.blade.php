@extends('layouts.welcomeLayout')
@section('title', 'academa|restPassword')
@section('content')
<div class="min-h-screen flex justify-center items-center bg-gray-100  ">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Reset Password</h2>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @error('email')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Send Password Reset Link
            </button>
        </form>
    </div>
</div>
@endsection