@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Edit Category</h1>
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('admin.update-category', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                class="mt-1 p-2 w-full border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="parent_id" class="block text-gray-700">Parent Category</label>
            <select id="parent_id" name="parent_id" class="mt-1 p-2 w-full border border-gray-300 rounded">
                <option value="">-- Select Parent Category --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update
                Category</button>
        </div>
    </form>
</div>

@endsection