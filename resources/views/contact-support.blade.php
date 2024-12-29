@extends('layouts.welcomeLayout')

@section('title', 'Contact Support')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
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
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Contact Support</h1>
        <p class="text-lg text-gray-700 mb-6">If you have any questions or need help, please fill out the form below,
            and our support team will get back to you as soon as possible.</p>

        <form method="POST" action="{{ route('support.submit') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700">Your Name</label>
                <input type="text" id="name" name="name"
                    class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your full name" required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Your Email</label>
                <input type="email" id="email" name="email"
                    class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your email" required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-semibold text-gray-700">Message</label>
                <textarea id="message" name="message" rows="4"
                    class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Write your message" required></textarea>
                @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Submit</button>
        </form>
    </div>
</div>
@endsection