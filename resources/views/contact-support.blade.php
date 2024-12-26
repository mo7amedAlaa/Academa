<!-- resources/views/contact-support.blade.php -->
@extends('layouts.welcomeLayout')

@section('title', 'Contact Support')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Contact Support</h1>
        <p class="text-lg text-gray-700 mb-6">If you have any questions or need help, please fill out the form below,
            and our support team will get back to you as soon as possible.</p>

        <form method="POST" action="{{ route('support.submit') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700">Your Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Your Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-semibold text-gray-700">Message</label>
                <textarea id="message" name="message" rows="4" class="w-full p-2 border rounded-md" required></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Submit</button>
        </form>
    </div>
</div>
@endsection