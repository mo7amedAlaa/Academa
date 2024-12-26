@extends('layouts.Layout')
@section('title', 'Academa | Shopping Cart')
@section('content')
<div class="container mx-auto  py-12 px-2 md:px-4 min-h-screen">
    @if(session('error'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('error') }}",
                backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                close: true,
                duration: 3000
            }).showToast();
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('success') }}",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                close: true,
                duration: 3000
            }).showToast();
        });
    </script>
    @endif
    <h1 class="text-4xl font-semibold mb-6 text-indigo-700">Shopping Cart</h1>
    <p class="text-lg mb-8 text-gray-700">Courses you have added to your Cart!</p>
    @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(count($cartItems) > 0)
    <table class="table-auto w-full mb-6">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">image</th>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">Price After discount</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $id => $item)
            <tr class="border-t">

                <td class="px-4 py-2 flex justify-center items-center"><img src="{{asset($item['cover_image']) }}"
                        alt="{{ $item['name'] }}" class="w-14 h-14"></td>
                <td class="px-4 py-2">
                    <form action="{{route('courses.show', $item['id'])}}" method="get">
                        @csrf
                        @method('GET')
                        <button type="submit" title="Show Details" class="text-xl text-blue-500 hover:text-blue-700">
                            {{ $item['name'] }} </button>
                    </form>
                </td>
                <td class="px-4 py-2 text-green-500">${{ $item['price'] }}</td>
                <td class="px-4 py-2">
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="text-red-500 hover:underline">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right font-bold">
        Total: ${{ array_sum(array_map(function ($item) { return $item['price']; }, $cartItems)) }}
    </div>
    <div class="text-right mt-4">
        <a href="{{ route('checkout') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Proceed to Checkout</a>
    </div>

    @else
    <div class="text-center bg-gray-100 p-6 rounded-lg shadow-md">
        <p class="text-gray-700 text-lg mb-4">Your cart is empty.!</p>
        <a href="{{ route('welcome') }}"
            class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">
            Browse Courses
        </a>
    </div>

    @endif
</div>
@endsection