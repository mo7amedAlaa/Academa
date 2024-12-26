@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Settings</h1>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.update-settings') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="site_name" class="block text-gray-700"> Site Name </label>
            <input type="text" id="site_name" name="site_name" value="{{ $settings['site_name'] }}"
                class="mt-1 p-2 w-full border border-gray-300 rounded">
            @error('site_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-4">
            <label for="site_email" class="block text-gray-700"> Contact Email </label>
            <input type="email" id="site_email" name="site_email" value="{{ $settings['site_email'] }}"
                class="mt-1 p-2 w-full border border-gray-300 rounded">
            @error('site_email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="site_logo" class="block text-gray-700">Site Logo</label>
            <input type="file" id="site_logo" name="site_logo" class="mt-1 p-2 border border-gray-300 rounded">
            @error('site_logo')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @if($settings['site_logo'])
            <div class="mt-4">
                <img src="{{ asset($settings['site_logo']) }}" alt="Logo" class="h-16 w-16 object-cover">
            </div>
            @endif
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"> Save Settings</button>
    </form>
</div>
@endsection