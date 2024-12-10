@extends('layouts.Layout')

@section('title', 'Create Course')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6">Create a New Course</h1>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter course title"
                required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('title')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Enter course description" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                placeholder="Enter course price"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('price')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="discount" class="block text-sm font-medium text-gray-700">Discount (%)</label>
            <input type="number" name="discount" id="discount" step="0.01" value="{{ old('discount') }}"
                placeholder="Enter discount percentage"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('discount')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="max_students" class="block text-sm font-medium text-gray-700">Maximum Students</label>
            <input type="number" name="max_students" id="max_students" value="{{ old('max_students') }}"
                placeholder="Enter maximum number of students"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('max_students')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Image</label>
            <input type="file" name="cover_image" id="cover_image" placeholder="Choose a cover image"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('cover_image')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="duration_hours" class="block text-sm font-medium text-gray-700">Duration (days)</label>
            <input type="number" name="duration_hours" id="duration_hours" value="{{ old('duration_hours') }}"
                placeholder="Enter course duration in days"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('duration_hours')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                placeholder="Select start date"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('start_date')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" id="category_id"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="level_id" class="block text-sm font-medium text-gray-700">Level</label>
            <select name="level_id" id="level_id"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Select a level</option>
                @foreach($levels as $level)
                <option value="{{ $level->id }}" {{ old('level_id')==$level->id ? 'selected' : '' }}>
                    {{ $level->name }}
                </option>
                @endforeach
            </select>
            @error('level_id')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="draft" {{ old('status')=='draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status')=='published' ? 'selected' : '' }}>Published</option>
                <option value="archived" {{ old('status')=='archived' ? 'selected' : '' }}>Archived</option>
            </select>
            @error('status')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="isFree" id="isFree" value="1" {{ old('isFree') ? 'checked' : '' }}
                class="mr-2">
            <label for="isFree" class="text-sm font-medium text-gray-700">Is this course free?</label>
        </div>

        <div>
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Create Course</button>
        </div>
    </form>
</div>
@endsection
