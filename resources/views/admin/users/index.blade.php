@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Manage Users</h1>

    <div class="mb-4 flex items-center space-x-2">
        <form method="GET" action="{{ route('admin.manage.users') }}" class="flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Name or Email"
                class="border-gray-300 border rounded px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Users List</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @foreach($user->getRoleNames() as $role)
                        <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 w-full text-center rounded">
                            {{ $role }}
                        </span>
                        @endforeach
                    </td>
                    <td class="py-2 px-4 border-b flex space-x-5">
                        <a href="{{ route('admin.edit-user', $user->id) }}"
                            class="bg-blue-500 text-white px-3 w-full py-1 rounded hover:bg-blue-600 text-center ">Edit</a>
                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST"
                            class="inline-block w-full"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-3 py-1  w-full rounded hover:bg-red-600 text-center">Delete</button>
                        </form>

                        @if($user->hasRole('instructor'))

                        <form action="{{ route('admin.users.toggle-ban', $user->id) }}" method="POST"
                            class="inline w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="bg-{{ $user->instructor->is_active ? 'gray' : 'green' }}-500 text-white px-3 py-1 min-w-32 w-full rounded   text-center">
                                {{ $user->instructor->is_active ? 'Ban' : 'UnBan' }}
                            </button>
                        </form>

                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection