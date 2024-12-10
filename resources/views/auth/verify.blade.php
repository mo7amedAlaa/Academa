@extends('layouts.Layout')

@section('title', 'Verify Email')

@section('content')

<div class="flex justify-center items-center min-h-screen">
    <div class="max-w-lg p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Verify Your Email</h1>
        <p class="text-lg text-gray-700 mb-6">
            Please verify your email address by clicking the link we just emailed to you.
            If you didn’t receive the email, click the button below to request another.
        </p>


        @if (session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            A new verification link has been sent to your email address.
        </div>
        @endif


        <form method="get" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg text-lg font-semibold">
                Resend Verification Email
            </button>
        </form>
    </div>
</div>
@endsection
