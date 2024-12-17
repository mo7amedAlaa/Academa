@extends('layouts.Layout')

@section('title', 'Account Settings')

@section('content')
<div class="container mx-auto flex justify-center items-center  py-12 px-2 md:px-4 min-h-screen">
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">

        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Account Settings</h1>

        <!-- Success or Error Message -->
        @if(session('status'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('status') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
            {{ session('error') }}
        </div>
        @endif

        <!-- Validation Errors -->
        @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Account Settings Form -->
        <form action="{{route('account.update')}}" method="POST">
            @csrf
            @method('PUT')

            <!-- Current Password Section -->
            <div class="mb-6">
                <label for="current_password" class="block text-lg font-semibold text-gray-800">Current Password</label>
                <input type="password" name="current_password" id="current_password"
                    class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-md">
                @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Section -->
            <div class="mb-6">
                <label for="email" class="block text-lg font-semibold text-gray-800">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-md">
                <small class="text-gray-500">We will send notifications to this email.</small>
            </div>

            <!-- Password Section -->
            <div class="mb-6">
                <label for="password" class="block text-lg font-semibold text-gray-800">New Password</label>
                <input type="password" name="password" id="password"
                    class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-md">
                <small class="text-gray-500">Leave blank if you don't want to change the password.</small>
            </div>

            <!-- Confirm Password Section -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-lg font-semibold text-gray-800">Confirm
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-md">
            </div>



            <!-- Save Changes Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-500 text-white hover:bg-indigo-600 py-2 px-6 rounded-lg text-lg font-semibold">
                    Save Changes
                </button>
            </div>
        </form>
        <!-- Account Deletion Section -->
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