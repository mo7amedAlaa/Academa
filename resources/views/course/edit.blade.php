@extends('layouts.Layout')

@section('title', 'Edit Course')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Course: {{ $course->title }}</h2>
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

    <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col space-y-6 ">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}"
                placeholder="Enter course title" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('title')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Enter course description" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $course->description) }}</textarea>
            @error('description')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $course->price) }}"
                placeholder="Enter course price"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('price')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="discount" class="block text-sm font-medium text-gray-700">Discount (%)</label>
            <input type="number" name="discount" id="discount" step="0.01"
                value="{{ old('discount', $course->discount) }}" placeholder="Enter discount percentage"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('discount')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="max_students" class="block text-sm font-medium text-gray-700">Maximum Students</label>
            <input type="number" name="max_students" id="max_students"
                value="{{ old('max_students', $course->max_students) }}" placeholder="Enter maximum number of students"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('max_students')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="duration_hours" class="block text-sm font-medium text-gray-700">Duration (days)</label>
            <input type="number" name="duration_hours" id="duration_hours"
                value="{{ old('duration_hours', $course->duration_hours) }}" placeholder="Enter course duration in days"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('duration_hours')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $course->start_date) }}"
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
                <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ?
                    'selected' : '' }}>
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
                <option value="{{ $level->id }}" {{ old('level_id', $course->level_id) == $level->id ? 'selected' : ''
                    }}>
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
                <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : ''
                    }}>Published</option>
                <option value="archived" {{ old('status', $course->status) == 'archived' ? 'selected' : '' }}>Archived
                </option>
            </select>
            @error('status')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class=" flex items-center justify-center">

            <div class="w-full ">
                <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Image</label>
                <input type="file" name="cover_image" id="cover_image" placeholder="Choose a cover image"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('cover_image')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full flex items-center justify-center bg-gray-100 ">

                @if($course->cover_image)
                <div class="w-32 h-32 rounded-lg">
                    <img src="{{ asset($course->cover_image) }}" alt="Current cover image"
                        class=" w-full rounded-lg shadow-sm">
                </div>
                @else
                <p>no current image</p>
                @endif
            </div>
        </div>
        <div class="flex items-center">
            <input type="checkbox" name="isFree" id="isFree" value="1" {{ old('isFree', $course->isFree) ? 'checked' :
            '' }}
            class="mr-2">
            <label for="isFree" class="text-sm font-medium text-gray-700">Is this course free?</label>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Course</button>
        </div>
    </form>
</div>
@endsection