@extends('layouts.Layout')

@section('title', 'Edit Course')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Course: {{ $course->title }}</h2>
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="title" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Title</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-pencil-alt text-gray-600"></i>
                    <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}"
                        placeholder="Enter course title" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('title')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="description" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Description</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-file-alt text-gray-600"></i>
                    <textarea name="description" id="description" rows="4" placeholder="Enter course description"
                        required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $course->description) }}</textarea>
                </div>
                @error('description')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Price -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="price" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Price</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-dollar-sign text-gray-600"></i>
                    <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $course->price) }}"
                        placeholder="Enter course price"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('price')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Discount -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="discount" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Discount (%)</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-percent text-gray-600"></i>
                    <input type="number" name="discount" id="discount" step="0.01"
                        value="{{ old('discount', $course->discount) }}" placeholder="Enter discount percentage"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('discount')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Max Students -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="max_students" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Max
                Students</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-users text-gray-600"></i>
                    <input type="number" name="max_students" id="max_students"
                        value="{{ old('max_students', $course->max_students) }}" placeholder="Enter max students"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('max_students')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Duration -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="duration_hours" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Duration
                (hours)</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-clock text-gray-600"></i>
                    <input type="number" name="duration_hours" id="duration_hours"
                        value="{{ old('duration_hours', $course->duration_hours) }}"
                        placeholder="Enter duration in hours"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('duration_hours')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Start Date -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="start_date" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Start Date</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar-day text-gray-600"></i>
                    <input type="date" name="start_date" id="start_date"
                        value="{{ old('start_date', $course->start_date) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('start_date')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Category -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Category</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-list text-gray-600"></i>
                    <select name="category_id" id="category_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id
                            ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Level -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="level_id" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Level</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-graduation-cap text-gray-600"></i>
                    <select name="level_id" id="level_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select a level</option>
                        @foreach($levels as $level)
                        <option value="{{ $level->id }}" {{ old('level_id', $course->level_id) == $level->id ?
                            'selected' : '' }}>
                            {{ $level->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('level_id')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Status -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="status" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Status</label>
            <div class="w-full md:w-3/4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-flag-checkered text-gray-600"></i>
                    <select name="status" id="status"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : ''
                            }}>Published</option>
                        <option value="archived" {{ old('status', $course->status) == 'archived' ? 'selected' : ''
                            }}>Archived</option>
                    </select>
                </div>
                @error('status')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Free Course Checkbox -->
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="isFree" id="isFree" value="1" {{ old('isFree', $course->isFree) ? 'checked' :
            '' }}
            class="mr-2">
            <label for="isFree" class="text-sm font-medium text-gray-700">Is this course free?</label>
        </div>

        <!-- Cover Image -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
            <label for="cover_image" class="block text-sm font-medium text-gray-700 w-full md:w-1/4">Cover Image</label>
            <div class="w-full md:w-3/4">
                <input type="file" name="cover_image" id="cover_image" placeholder="Choose a cover image"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('cover_image')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Current Image Preview -->
        <div class="flex items-center justify-center">
            @if($course->cover_image)
            <div class="w-32 h-32 rounded-lg">
                <img src="{{ asset($course->cover_image) }}" alt="Current cover image"
                    class="w-full rounded-lg shadow-sm">
            </div>
            @else
            <p class="text-sm text-gray-600">No current image</p>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-center mt-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg text-lg">Update Course</button>
        </div>
    </form>
</div>
<script>
    document.getElementById('isFree').addEventListener('change', function () {
        const priceField = document.getElementById('price');
        if (this.checked) {
            priceField.value = '';
            priceField.disabled = true;
        } else {
            priceField.disabled = false;
        }
    });
</script>
@endsection