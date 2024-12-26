@extends('layouts.admin_layout')

@section('title', 'Admin Profile')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Admin Profile</h1>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white p-6 rounded shadow-md">
        <form action="{{ route('admin.update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="profile_picture" class="block text-gray-700 font-medium mb-2">Profile Picture</label>
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset($admin->avatar) }}" alt="Profile Picture" class="w-16 h-16 rounded-full">
                        <input type="file" name="profile_picture" id="profile_picture"
                            class="block w-full border border-gray-300 p-2 rounded">
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ $admin->name }}"
                        class="block w-full border border-gray-300 p-2 rounded" required>
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ $admin->email }}"
                        class="block w-full border border-gray-300 p-2 rounded" required>
                </div>

                <div>
                    <label for="current_password" class="block text-gray-700 font-medium mb-2">Current Password</label>
                    <input type="password" name="current_password" id="current_password"
                        class="block w-full border border-gray-300 p-2 rounded" required>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">New Password</label>
                    <input type="password" name="password" id="password"
                        class="block w-full border border-gray-300 p-2 rounded">
                    <small class="text-gray-500">Leave blank to keep current password</small>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update
                    Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection