@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Manage Categories</h1>
    <a href="{{ route('admin.create-category') }}"
        class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">Add New Category</a>

    <div class="mb-4 flex items-center space-x-2">
        <form method="GET" action="{{ route('admin.manage.categories') }}" class="flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Name or ID"
                class="border-gray-300 border rounded px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Categories List</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent
                        Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($categories2 as $category)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->parent?->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right flex space-x-5">
                        <a href="{{ route('admin.edit-category', $category->id) }}"
                            class="bg-blue-500 text-white px-3 w-full py-1 rounded hover:bg-blue-600 text-center ">Edit</a>
                        <a href="{{ route('admin.delete-category', $category->id) }}"
                            class="bg-red-500 text-white px-3 w-full py-1 rounded hover:bg-red-600 text-center ">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $categories2->links() }}
        </div>
    </div>
</div>
@endsection