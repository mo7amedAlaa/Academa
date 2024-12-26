@extends('layouts.Layout')

@section('title', 'Banned - Instructor')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96 text-center">
        <h1 class="text-2xl font-bold text-red-600 mb-4">Your account has been banned</h1>
        <p class="text-lg text-gray-700 mb-4">We regret to inform you that your account has been temporarily suspended.
            Please contact support if you believe this is a mistake.</p>
        <p class="text-md text-gray-500 mb-6">Our team is reviewing your account, and you should be unbanned within the
            next 24-48 hours. We apologize for any inconvenience caused.</p>

        <!-- You can replace this link with an actual contact page or form -->
        <a href="{{ route('support.contact') }}" class="text-blue-500 hover:text-blue-700">Contact Support</a>


    </div>
</div>
@endsection