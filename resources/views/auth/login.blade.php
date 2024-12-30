@extends('layouts.welcomeLayout')

@section('title', 'academa|Login')

@section('content')

<div class="flex justify-center items-center min-h-screen">
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

    <div class="hidden lg:block p-8 w-full ">
        <img src="{{ asset('images/reg.webp') }}" alt="Academa Logo" class="w-full h-full ">
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg w-full">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Login to Your Account</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            @method('POST')
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

            <div class="mb-4 flex items-center justify-between">
                <div>
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox text-blue-500">
                    <label for="remember" class="ml-2 text-gray-700">Remember me</label>
                </div>
                <div><a href="{{ route('password.request') }}"
                        class="text-blue-500 hover:underline cursor-pointer">Reset Password?</a></div>
            </div>

            <div class="mt-6">
                <button
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </div>
            <a href="{{ url('login/google') }}"
                class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 flex items-center justify-center mt-4">
                <i class="fab fa-google mr-2"></i> Login With Google
            </a>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline cursor-pointer">Don't have an
                account? Register</a>
        </div>
    </div>
</div>

@endsection