@extends('layouts.Layout')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">

    <h1 class="text-3xl font-bold mb-6">Edit User</h1>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user2->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user2->name) }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none">
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">Update
            User</button>
    </form>
</div>
@endsection