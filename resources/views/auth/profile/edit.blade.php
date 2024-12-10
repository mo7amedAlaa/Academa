@extends('layouts.Layout')

@section('title', 'Edit Profile')

@section('content')

<div class="  mx-auto p-6 bg-white rounded-lg shadow-md">

    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Edit Profile</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- General Information -->
        <div class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">General Information</h3>

            <div class="mb-4">
                <label for="name" class="block text-lg text-gray-700 font-semibold">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2" required>
            </div>

            <div class="mb-4">
                <label for="avatar" class="block text-lg text-gray-700 font-semibold">Avatar (Profile Picture)</label>
                <input type="file" id="avatar" name="avatar" class="w-full p-3 border border-gray-300 rounded-md mt-2">
                @if($user->avatar)
                <img src="{{ asset($user->avatar) }}" alt="Current Avatar"
                    class="w-20 h-20 mt-4 rounded-full object-cover">
                @endif
            </div>
        </div>

        <!-- Student-Specific Information -->
        @if($student)
        <div class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Student Information</h3>
            @if($categories)
            <label for="interests_field" class="block text-lg text-gray-700">Select Interests Field</label>
            <select name="interests_field" id="interests_field"
                class="form-select block w-full p-2 mt-2 border border-gray-300 rounded-lg text-gray-700">
                <option value="none">None of the above</option>
                @foreach($categories as $category)
                @if(!$category->parent_id)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
            </select>
            @endif
            <div class="mb-4">
                <label for="phone" class="block text-lg text-gray-700 font-semibold">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone) }}"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2">
            </div>

            <div class="mb-4">
                <label for="address" class="block text-lg text-gray-700 font-semibold">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address', $student->address) }}"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2">
            </div>
        </div>
        @endif

        <!-- Instructor-Specific Information -->
        @if($instructor)
        <div class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Instructor Information</h3>

            <div class="mb-4">
                <label for="phone" class="block text-lg text-gray-700 font-semibold">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $instructor->phone) }}"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2">
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-lg text-gray-700 font-semibold">Bio</label>
                <textarea id="bio" name="bio" rows="4"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2">{{ old('bio', $instructor->bio) }}</textarea>
            </div>
            <p class="text-lg text-gray-700"><strong>Age:</strong>
                <input type="number" name="age" value="{{ $instructor->age ?? 'Not provided' }}"
                    class="bg-gray-100 rounded-md p-2 mt-2 w-full" placeholder="Enter age" min="6" max="120">
            </p>
            <div class="mb-4">
                <label for="nationality" class="block text-lg text-gray-700 font-semibold">Nationality</label>
                <input type="text" id="nationality" name="nationality"
                    value="{{ old('nationality', $instructor->nationality) }}"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2">
            </div>

            <div class="mb-4">
                <label for="experience_years" class="block text-lg text-gray-700 font-semibold">Experience
                    (Years)</label>
                <input type="number" id="experience_years" name="experience_years"
                    value="{{ old('experience_years', $instructor->experience_years) }}"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2">
            </div>
        </div>
        @endif

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="bg-indigo-500 text-white py-2 px-6 rounded-lg text-lg font-semibold capitalize">
                Update Profile
            </button>
        </div>
    </form>

</div>

@endsection
