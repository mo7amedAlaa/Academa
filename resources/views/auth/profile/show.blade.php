@extends('layouts.Layout')

@section('title', 'User Profile')

@section('content')
<div class="flex justify-center p-4 sm:p-6 items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-4xl mx-auto p-4 sm:p-6 bg-white rounded-lg shadow-md space-y-6 sm:space-y-8">

        @if(session('status'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('status') }}
        </div>
        @endif

        <div class="flex flex-col sm:flex-row items-center sm:space-x-6">
            <img src="{{ asset($user->avatar) }}" alt="User Avatar"
                class="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover mb-4 sm:mb-0">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                <p class="text-base sm:text-lg text-gray-600">{{ $user->email }}</p>
                <p class="text-sm text-gray-500 mt-2">
                    {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                </p>
            </div>
        </div>

        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg shadow-md space-y-4">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">Profile Information</h2>

            @if($student)
            <div>
                <p class="text-base sm:text-lg text-gray-700"><i class="fas fa-briefcase mr-2"></i><strong>Interests
                        Field:</strong> {{ $category->name ?? 'Not set' }}</p>
                <p class="text-base sm:text-lg text-gray-700"><i
                        class="fas fa-phone-alt mr-2"></i><strong>Phone:</strong> {{ $student->phone ?? 'Not provided'
                    }}</p>
                <p class="text-base sm:text-lg text-gray-700"><i
                        class="fas fa-map-marker-alt mr-2"></i><strong>Address:</strong> {{ $student->address ?? 'Not
                    provided' }}</p>
                <p class="text-base sm:text-lg text-gray-700"><i class="fas fa-cogs mr-2"></i><strong>Status:</strong>
                    {{ $student->is_premium ? 'Premium Member' : 'Standard Member' }}</p>
            </div>
            @elseif($instructor)
            <div>
                <p class="text-base sm:text-lg text-gray-700"><i
                        class="fas fa-phone-alt mr-2"></i><strong>Phone:</strong> {{ $instructor->phone ?? 'Not
                    provided' }}</p>
                <p class="text-base sm:text-lg text-gray-700"><i class="fas fa-user-tie mr-2"></i><strong>Bio:</strong>
                    {{ $instructor->bio ?? 'Not provided' }}</p>
                <p class="text-base sm:text-lg text-gray-700"><i
                        class="fas fa-flag mr-2"></i><strong>Nationality:</strong> {{ $instructor->nationality ?? 'Not
                    provided' }}</p>
                <p class="text-base sm:text-lg text-gray-700"><i class="fas fa-calendar-alt mr-2"></i><strong>Experience
                        (Years):</strong> {{ $instructor->experience_years ?? 'Not provided' }}</p>
                <p class="text-base sm:text-lg text-gray-700"><i
                        class="fas fa-birthday-cake mr-2"></i><strong>Age:</strong> {{ $instructor->age ?? 'Not
                    provided' }}</p>
                <p class="text-base sm:text-lg text-gray-700"><i
                        class="fas fa-check-circle mr-2"></i><strong>Status:</strong> {{ $instructor->is_active ?
                    'Active' : 'Inactive' }}</p>
            </div>
            @else
            <p class="text-base sm:text-lg text-gray-700">No additional information available.</p>
            @endif
        </div>

        <!-- Courses Section -->
        @if($student && $student->courses->isNotEmpty() || $instructor && $instructor->courses->isNotEmpty())
        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg shadow-md space-y-4">
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-800">
                {{ $student ? 'Enrolled Courses' : 'Managed Courses' }}
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach(($student ? $student->courses : $instructor->courses) as $course)
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                    <h4 class="text-base sm:text-lg font-semibold text-gray-800">{{ $course->title }}</h4>
                    <a href="{{ route('courses.show', $course->id) }}"
                        class="text-indigo-500 hover:underline mt-2 inline-block">
                        <i class="fas fa-eye mr-2"></i> View Course
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="text-base sm:text-lg text-gray-700">No courses available.</p>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-x-4">
            <!-- Edit Profile Button -->
            <a href="{{ route('profile.edit') }}"
                class="bg-indigo-500 text-white w-full sm:w-auto text-center hover:bg-indigo-600 py-2 px-6 rounded-lg text-base sm:text-lg font-semibold capitalize">
                <i class="fas fa-edit mr-2"></i> Edit Profile
            </a>

            <!-- Dashboard Button -->
            @auth
            @php
            $dashboardRoute = '';
            $role = auth()->user()->roles->first()->name ?? null; // Assuming roles are stored via a relation
            // Set the dashboard route based on the role
            if ($role === 'student') {
            $dashboardRoute = route('student.dashboard');
            } elseif ($role === 'instructor') {
            $dashboardRoute = route('instructors.dashboard');
            } elseif ($role === 'admin') {
            $dashboardRoute = route('admin.dashboard');
            }
            @endphp

            @if($dashboardRoute)
            <a href="{{ $dashboardRoute }}"
                class="bg-blue-500 text-white w-full sm:w-auto text-center hover:bg-blue-600 py-2 px-6 rounded-lg text-base sm:text-lg font-semibold">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
            @endif
            @endauth

            <!-- Resend Verification Email for non-verified users -->
            @if(!$user->email_verified_at)
            <form action="{{ route('verification.resend') }}" method="get" class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                    class="bg-blue-500 text-white hover:bg-blue-600 w-full sm:w-auto text-center py-2 px-6 rounded-lg text-base sm:text-lg font-semibold">
                    <i class="fas fa-envelope mr-2"></i> Resend Verification Email
                </button>
            </form>
            @endif

            <!-- Account Settings Button -->
            <a href="{{ route('settings') }}"
                class="bg-gray-500 text-white hover:bg-gray-600 w-full sm:w-auto text-center py-2 px-6 rounded-lg text-base sm:text-lg font-semibold">
                <i class="fas fa-cogs mr-2"></i> Account Settings
            </a>
        </div>

    </div>
</div>
@endsection