@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6 max-w-screen-lg">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Create New Category</h1>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow-md">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.store-category') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Category Name</label>
            <input type="text" id="name" name="name"
                class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none"
                placeholder="Enter category name" required>
            @error('name')
            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="parent_id" class="block text-gray-700 font-semibold">Parent Category</label>
            <select id="parent_id" name="parent_id"
                class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
                <option value="0">-- Select Parent Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                Create Category
            </button>
        </div>
    </form>
</div>
@endsection