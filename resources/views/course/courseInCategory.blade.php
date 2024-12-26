@extends('layouts.Layout')

@section('title', "academa |Courses in $category->name ")

@section('content')
<div class="container mx-auto p-8 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Courses in <span class="text-blue-600">{{ $category->name }}</span>
    </h1>
    @if($category->courses->isEmpty())
    <div class="text-center bg-gray-100 border border-gray-300 p-8 rounded-lg shadow-sm">
        <h2 class="text-xl font-semibold text-gray-700">No Courses Available</h2>
        <p class="text-gray-600 mt-2">It seems there are no courses in this category at the moment. Check back later!
        </p>

    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  xl:grid-cols-4 gap-6">
        @foreach ($category->courses as $course)
        @include('partials.course_card', ['course' => $course])
        @endforeach
    </div>

    @endif
</div>
@endsection