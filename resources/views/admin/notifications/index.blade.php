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

    {{-- Clear All Notifications Button --}}
    <form action="{{ route('notifications.clear') }}" method="POST" class="mb-4">
        @csrf
        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Clear All Notifications</button>
    </form>

    <div class="notifications-list">
        @forelse($notifications as $notification)
        @php
        $type = class_basename($notification->type);
        @endphp

        <div
            class="notification-item flex justify-between items-center p-4 {{ $notification->read_at ? 'bg-white' : 'bg-blue-100' }}">
            @if($type === 'SupportRequestNotification')
            {{-- Custom handling for SupportRequestNotification --}}
            <div>
                <p><strong>Support Request:</strong></p>
                <p class="font-semibold">{{ $notification->data['name'] }} has submitted a support request.</p>
                <p>{{ Str::limit($notification->data['message'], 100) }}</p>
                <small class="text-gray-500">
                    {{ $notification->created_at->diffForHumans() }}
                </small>
            </div>
            @else
            <a href="{{ route('notification.read', $notification->id) }}" class="block">
                <p>New notification received.</p>
                <small class="text-gray-500">
                    {{ $notification->created_at->diffForHumans() }}
                </small>
            </a>
            @endif

            {{-- Delete Button for Each Notification --}}
            <form action="{{ route('notification.delete', $notification->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this notification?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 ml-4">
                    <i class="fas fa-times"></i> <!-- X button icon -->
                </button>
            </form>
        </div>

        @empty
        <p>No notifications yet.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $notifications->links() }} <!-- Pagination links -->
    </div>
</div>
@endsection