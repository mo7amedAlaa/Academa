@extends('layouts.Layout')

@section('title', 'Account Settings')

<!-- Toastify Success/Error Scripts -->
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

@section('content')
<div class="container mx-auto flex justify-center items-center py-12 px-2 md:px-4 min-h-screen">
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Account Settings</h1>

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('account.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="current_password" class="block text-lg font-semibold text-gray-800">Current Password</label>
                <input type="password" name="current_password" id="current_password"
                    class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-indigo-500"
                    aria-describedby="currentPasswordHelp" required>
                <small id="currentPasswordHelp" class="text-gray-500">Enter your current password to update account
                    settings.</small>
                @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-lg font-semibold text-gray-800">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-indigo-500"
                    aria-describedby="emailHelp" required>
                <small id="emailHelp" class="text-gray-500">We will send notifications to this email.</small>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-lg font-semibold text-gray-800">New Password</label>
                <input type="password" name="password" id="password"
                    class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-indigo-500"
                    aria-describedby="passwordHelp">
                <small id="passwordHelp" class="text-gray-500">Leave blank if you don't want to change the
                    password.</small>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-lg font-semibold text-gray-800">Confirm
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-indigo-500">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-500 text-white hover:bg-indigo-600 py-2 px-6 rounded-lg text-lg font-semibold">
                    Save Changes
                </button>
            </div>
        </form>

        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Delete Account</h3>
            <p class="text-gray-600 mt-2">If you wish to permanently delete your account, you can do so here. This
                action cannot be undone.</p>
            <form action="{{ route('account.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="mt-4 bg-red-500 text-white hover:bg-red-600 py-2 px-6 rounded-lg text-lg font-semibold">
                    Delete Account
                </button>
            </form>
        </div>
    </div>
</div>
@endsection