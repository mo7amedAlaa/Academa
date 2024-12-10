@extends('layouts.Layout')

@section('title', 'User Profile')

@section('content')
<div class="flex justify-center p-3 items-center min-h-screen bg-gray-100">
    <div class=" w-full  mx-auto p-6 bg-white rounded-lg shadow-md space-y-8">

        <!-- Flash Messages -->
        @if(session('status'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('status') }}
        </div>
        @endif

        <!-- Profile Header -->
        <div class="flex items-center">
            <img src="{{ asset($user->avatar) }}" alt="User Avatar" class="w-24 h-24 rounded-full object-cover">
            <div class="ml-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                <p class="text-lg text-gray-600">{{ $user->email }}</p>
                <p class="text-sm text-gray-500 mt-2">
                    {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                </p>
            </div>
        </div>

        <!-- Profile Information Section -->
        <div class="bg-gray-50 p-6 rounded-lg shadow space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Profile Information</h2>

            @if($student)
            <!-- Student Information -->
            <div>
                <p class="text-lg text-gray-700"><strong>Interests Field:</strong> {{ $category->name ?? 'Not set' }}
                </p>
                <p class="text-lg text-gray-700"><strong>Phone:</strong> {{ $student->phone ?? 'Not provided' }}</p>
                <p class="text-lg text-gray-700"><strong>Address:</strong> {{ $student->address ?? 'Not provided' }}</p>
                <p class="text-lg text-gray-700"><strong>Status:</strong> {{ $student->is_premium ? 'Premium Member' :
                    'Standard Member' }}</p>
            </div>
            @elseif($instructor)
            <!-- Instructor Information -->
            <div>
                <p class="text-lg text-gray-700"><strong>Phone:</strong> {{ $instructor->phone ?? 'Not provided' }}</p>
                <p class="text-lg text-gray-700"><strong>Bio:</strong> {{ $instructor->bio ?? 'Not provided' }}</p>
                <p class="text-lg text-gray-700"><strong>Nationality:</strong> {{ $instructor->nationality ?? 'Not
                    provided' }}</p>
                <p class="text-lg text-gray-700"><strong>Experience (Years):</strong> {{ $instructor->experience_years
                    ?? 'Not provided' }}</p>
                <p class="text-lg text-gray-700"><strong>Age:</strong> {{ $instructor->age ?? 'Not provided' }}</p>
                <p class="text-lg text-gray-700"><strong>Status:</strong> {{ $instructor->is_active ? 'Active' :
                    'Inactive' }}</p>
            </div>
            @else
            <p class="text-lg text-gray-700">No additional information available.</p>
            @endif
        </div>

        <!-- Courses Section -->
        @if($student && $student->courses->isNotEmpty() || $instructor && $instructor->courses->isNotEmpty())
        <div class="bg-gray-50 p-6 rounded-lg shadow space-y-4">
            <h3 class="text-2xl font-semibold text-gray-800">
                {{ $student ? 'Enrolled Courses' : 'Managed Courses' }}
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach(($student ? $student->courses : $instructor->courses) as $course)
                <div class="bg-white p-4 rounded-lg shadow">
                    <h4 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h4>
                    <a href="{{ route('courses.show', $course->id) }}"
                        class="text-indigo-500 hover:underline mt-2 inline-block">View Course</a>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="text-lg text-gray-700">No courses available.</p>
        @endif

        <!-- Actions Section -->
        <div class="flex flex-wrap items-center justify-between space-x-4">
            <!-- Edit Profile -->
            <a href="{{ route('profile.edit') }}"
                class="bg-indigo-500 text-white hover:bg-indigo-600 py-2 px-6 rounded-lg text-lg font-semibold capitalize">
                Edit Profile
            </a>

            <!-- Become Premium -->
            @if($student && !$student->is_premium)
            <form action=" " method="POST">
                @csrf
                <button type="submit"
                    class="bg-green-500 text-white hover:bg-green-600 py-2 px-6 rounded-lg text-lg font-semibold">
                    Become Premium
                </button>
            </form>
            @elseif($student)
            <span class="bg-green-500 text-white py-2 px-6 rounded-lg text-lg font-semibold">Premium Member</span>
            @endif

            <!-- Email Verification -->
            @if(!$user->email_verified_at)
            <form action="{{ route('verification.resend') }}" method="get">
                @csrf
                <button type="submit"
                    class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-6 rounded-lg text-lg font-semibold">
                    Resend Verification Email
                </button>
            </form>
            @endif

            <!-- Account Settings -->
            <a href="{{ route('settings') }}"
                class="bg-gray-500 text-white hover:bg-gray-600 py-2 px-6 rounded-lg text-lg font-semibold">
                Account Settings
            </a>
        </div>

    </div>
</div>
@endsection
