@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6 max-w-screen-lg">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Category</h1>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow-md">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.update-category', $category->id) }}" method="POST"
        class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none"
                required>
            @error('name')
            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="parent_id" class="block text-gray-700 font-semibold">Parent Category</label>
            <select id="parent_id" name="parent_id"
                class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
                <option value="">-- Select Parent Category --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                </option>
                @endforeach
            </select>
            @error('parent_id')
            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                Update Category
            </button>
        </div>
    </form>
</div>

@endsection