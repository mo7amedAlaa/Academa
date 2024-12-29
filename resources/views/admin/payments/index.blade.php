@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6 max-w-screen-xl">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Payment Analysis</h1>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow-md">
        {{ session('success') }}
    </div>
    @endif

    <!-- Filter Form -->
    <div class="mb-6">
        <form action="{{ route('admin.payment-analysis') }}" method="GET">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label for="start_date" class="block text-gray-700">Start Date</label>
                    <input type="date" id="start_date" name="start_date"
                        class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
                </div>
                <div>
                    <label for="end_date" class="block text-gray-700">End Date</label>
                    <input type="date" id="end_date" name="end_date"
                        class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="mt-6 px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none transition duration-300 transform hover:scale-105">
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete History Form -->
    <div class="mb-6 flex justify-end">
        <form action="{{ route('admin.delete-payment-history') }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete all payment history?');">
            @csrf
            <button type="submit"
                class="px-6 py-3 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none transition duration-300 transform hover:scale-105">
                Delete All History
            </button>
        </form>
    </div>

    <!-- Payment Table -->
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <thead>
            <tr class="bg-gray-100">
                <th class="border-b border-gray-300 text-left px-4 py-2">ID</th>
                <th class="border-b border-gray-300 text-left px-4 py-2">Amount</th>
                <th class="border-b border-gray-300 text-left px-4 py-2">Payment Method</th>
                <th class="border-b border-gray-300 text-left px-4 py-2">Status</th>
                <th class="border-b border-gray-300 text-left px-4 py-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr class="hover:bg-gray-50 transition duration-300">
                <td class="border-b border-gray-300 px-4 py-2">{{ $payment->id }}</td>
                <td class="border-b border-gray-300 px-4 py-2">{{ $payment->amount }}</td>
                <td class="border-b border-gray-300 px-4 py-2">{{ $payment->payment_method }}</td>
                <td class="border-b border-gray-300 px-4 py-2">{{ $payment->status }}</td>
                <td class="border-b border-gray-300 px-4 py-2">{{ $payment->created_at->format('d-m-Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $payments->links() }}
    </div>

</div>
@endsection