@extends('layouts.Layout')
@section('title','Personalize')

@section('content')

<div class=" py-12 px-2 md:px-4 min-h-screen  flex items-center justify-center bg-gray-100">
    <div class=" w-3/4 bg-white shadow-md rounded-lg p-6 ">
        <h1 class="text-lg font-semibold mb-4">What field are you learning for?</h1>
        <form action="" method="post">
            @csrf
            @method ('POST')
            <div class="grid grid-cols-2 gap-4">
                @if($categories)
                @foreach($categories as $category)
                @if(!$category->parent_id)
                <label class="flex items-center space-x-2">
                    <input type="radio" name="interests_field" value="{{$category->id}}"
                        class="form-radio text-blue-600">
                    <span>{{$category->name}}</span>
                </label>
                @endif
                @endforeach
                @endif
                <label class="flex items-center space-x-2">
                    <input type="radio" name="interests_field" value="none" class="form-radio text-blue-600">
                    <span>None of the above</span>
                </label>
            </div>

            <h2 class="text-lg font-semibold mt-6 mb-4">Do you currently manage people?</h2>
            <div class="flex space-x-4">
                <label class="flex items-center space-x-2">
                    <input type="radio" name="manage_people" value="yes" class="form-radio text-blue-600">
                    <span>Yes</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="manage_people" value="no" class="form-radio text-blue-600">
                    <span>No</span>
                </label>
            </div>

            <button type="submit"
                class="mt-6 w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>

            @if($errors->any())
            <div class="mt-4 text-red-600">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
        </form>
    </div>
</div>
@endsection