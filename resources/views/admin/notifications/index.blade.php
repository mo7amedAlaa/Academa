@extends('layouts.admin_layout')

@section('title', 'Admin Profile')

@section('content')
<div class="container mx-auto p-6 max-w-screen-lg">

    <!-- Header -->
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Admin Profile</h1>

    <!-- Success or Error Messages -->
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow-md">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded shadow-md">
        {{ session('error') }}
    </div>
    @endif

    <!-- Clear All Notifications Button -->
    <form action="{{ route('notifications.clear') }}" method="POST" class="mb-6">
        @csrf
        <button type="submit"
            class="px-6 py-3 bg-red-600 text-white rounded hover:bg-red-700 transition duration-300 transform hover:scale-105">
            Clear All Notifications
        </button>
    </form>

    <!-- Notifications List -->
    <div class="notifications-list">
        @forelse($notifications as $notification)
        @php
        $type = class_basename($notification->type);
        @endphp

        <div
            class="notification-item flex justify-between items-center p-4 mb-4 {{ $notification->read_at ? 'bg-white' : 'bg-blue-100' }} shadow-md rounded-lg">
            <!-- Notification Content -->
            <div class="flex-1">
                @if($type === 'SupportRequestNotification')
                <p class="font-semibold">Support Request:</p>
                <p class="font-semibold">{{ $notification->data['name'] }} has submitted a support request.</p>
                <p class="text-gray-700">{{ Str::limit($notification->data['message'], 100) }}</p>
                <small class="text-gray-500">
                    {{ $notification->created_at->diffForHumans() }}
                </small>
                @else
                <a href="{{ route('notification.read', $notification->id) }}" class="block hover:text-blue-600">
                    <p class="text-gray-800 font-semibold">New notification received.</p>
                    <small class="text-gray-500">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>
                </a>
                @endif
            </div>

            <!-- Delete Button for Each Notification -->
            <form action="{{ route('notification.delete', $notification->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this notification?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-times"></i> <!-- X button icon -->
                </button>
            </form>
        </div>

        @empty
        <p class="text-gray-500">No notifications yet.</p>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
</div>
@endsection