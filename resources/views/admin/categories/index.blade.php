@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6 max-w-screen-xl">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Manage Categories</h1>

    <a href="{{ route('admin.create-category') }}"
        class="mb-4 inline-block px-6 py-3 bg-blue-600 text-white rounded shadow-md hover:bg-blue-700 transition duration-300 transform hover:scale-105">
        Add New Category
    </a>

    <div class="mb-4 flex items-center space-x-2">
        <form method="GET" action="{{ route('admin.manage.categories') }}"
            class="flex items-center space-x-2 w-full md:w-1/3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Name or ID"
                class="border-gray-300 border rounded px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none w-full">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                Search
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow-md transition-transform transform hover:scale-105">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Categories List</h2>
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
                <tr class="hover:bg-gray-50 transition-all duration-300 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->parent?->name ?? 'None'
                        }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right flex space-x-4">
                        <a href="{{ route('admin.edit-category', $category->id) }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                            Edit
                        </a>
                        <a href="{{ route('admin.delete-category', $category->id) }}"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 transform hover:scale-105">
                            Delete
                        </a>
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