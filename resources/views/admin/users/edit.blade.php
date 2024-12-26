@extends('layouts.Layout')

@section('content')
<div class="container mx-auto p-6">

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
                class="w-full border rounded px-4 py-2">
            @error('name')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update User</button>
    </form>
</div>
@endsection
