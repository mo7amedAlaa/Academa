@extends('layouts.Layout')
@section('title', 'Academa | Shopping Cart')
@section('content')
<div class="container mx-auto py-12 px-4 md:px-6 min-h-screen">
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

    <div class="flex items-center mb-6">
        <i class="fas fa-shopping-cart text-4xl text-indigo-700 mr-3"></i>
        <h1 class="text-4xl font-semibold text-indigo-700">Shopping Cart</h1>
    </div>
    <p class="text-lg mb-8 text-gray-700">Courses you have added to your Cart!</p>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(count($cartItems) > 0)
    <div class="overflow-x-auto">
        <table class="table-auto w-full mb-6">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Image</th>
                    <th class="px-4 py-2 text-left">Product</th>
                    <th class="px-4 py-2 text-left">Price After Discount</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $id => $item)
                <tr class="border-t">
                    <td class="px-4 py-2 flex justify-center items-center">
                        <img src="{{ asset($item['cover_image']) }}" alt="{{ $item['name'] }}"
                            class="w-16 h-16 md:w-20 md:h-20 object-cover">
                    </td>
                    <td class="px-4 py-2">
                        <form action="{{ route('courses.show', $item['id']) }}" method="get">
                            @csrf
                            @method('GET')
                            <button type="submit" title="Show Details"
                                class="text-xl text-blue-500 hover:text-blue-700">
                                <span class="block truncate" style="max-width: 150px;">{{ $item['name'] }}</span>
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-2 text-green-500">${{ $item['price'] }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="text-red-500 hover:underline">
                                <i class="fas fa-trash-alt mr-2"></i> Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right font-bold mb-4">
            Total: ${{ array_sum(array_map(function ($item) { return $item['price']; }, $cartItems)) }}
        </div>

        <div class="text-right">
            <a href="{{ route('checkout') }}"
                class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-600 flex items-center justify-center transition">
                <i class="fas fa-credit-card mr-2"></i> Proceed to Checkout
            </a>
        </div>
    </div>
    @else
    <div class="text-center bg-gray-100 p-6 rounded-lg shadow-md">
        <p class="text-gray-700 text-lg mb-4">Your cart is empty!</p>
        <a href="{{ route('welcome') }}"
            class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-lg text-lg hover:bg-indigo-700">
            Browse Courses
        </a>
    </div>
    @endif
</div>
@endsection