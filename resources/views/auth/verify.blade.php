@extends('layouts.Layout')

@section('title', 'Verify Email')

@section('content')
<div class="flex justify-center items-center min-h-screen p-4">
    <div class="max-w-lg w-full p-6 bg-white rounded-lg shadow-md">
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

        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="get" action="{{ route('verification.resend') }}" id="resendForm">
            @csrf
            <div class="relative">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-300"
                    id="resendButton">
                    Resend Verification Email
                </button>

                <!-- Loading Spinner -->
                <div id="loadingSpinner"
                    class="absolute inset-0 flex justify-center items-center bg-white opacity-75 hidden">
                    <div class="w-8 h-8 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
                </div>
            </div>
        </form>
    </div>
</div>




<script>
    document.getElementById('resendForm').addEventListener('submit', function (event) {
        event.preventDefault();
        document.getElementById('resendButton').disabled = true;
        document.getElementById('loadingSpinner').classList.remove('hidden');
        setTimeout(function () {
            document.getElementById('resendForm').submit();
        }, 500);
    });
</script>
@endsection