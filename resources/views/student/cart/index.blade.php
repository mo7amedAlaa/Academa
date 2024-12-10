@extends('layouts.Layout')
@section('title', 'Academa | Shopping Cart')
@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

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
    <p>Your cart is empty.</p>
    @endif
</div>
@endsection