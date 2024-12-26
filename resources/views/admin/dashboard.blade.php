@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6">
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
    <h1 class="text-3xl font-bold mb-6">Dashboard Statistics</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="p-4 bg-white rounded shadow flex items-center">
            <i class="fas fa-users text-blue-500 text-4xl mr-4"></i>
            <div>
                <h3 class="text-lg font-bold">Total Users</h3>
                <p class="text-2xl">{{ $totalUsers }}</p>
            </div>
        </div>

        <div class="p-4 bg-white rounded shadow flex items-center">
            <i class="fas fa-layer-group text-yellow-500 text-4xl mr-4"></i>
            <div>
                <h3 class="text-lg font-bold">Total Categories</h3>
                <p class="text-2xl">{{ $totalCategories }}</p>
            </div>
        </div>


        <div class="p-4 bg-white rounded shadow flex items-center">
            <i class="fas fa-dollar-sign text-green-500 text-4xl mr-4"></i>
            <div>
                <h3 class="text-lg font-bold">Total Payments</h3>
                <p class="text-2xl">${{ $totalPayments }}</p>
            </div>
        </div>
        <div class="p-4 bg-white rounded shadow flex items-center">
            <i class="fa-solid fa-swatchbook text-red-500 text-4xl mr-4"></i>
            <div>
                <h3 class="text-lg font-bold">Total Courses</h3>
                <p class="text-2xl">{{ $totalCourses }}</p>
            </div>
        </div>
        <div class="p-4 bg-white rounded shadow flex items-center">
            <i class="fa-solid fa-book-open text-cyan-500 text-4xl mr-4"></i>
            <div>
                <h3 class="text-lg font-bold">Total Lessons</h3>
                <p class="text-2xl ">{{ $totalLessons }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white p-5 mb-5 rounded">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="flex space-x-6">
            <div class="flex-1">
                <label for="year" class="block text-sm font-medium text-gray-700">Select Year:</label>
                <select id="year" name="year" class="mt-1 block w-full px-4 py-2">
                    @for($year = 2020; $year <= date('Y'); $year++) <option value="{{ $year }}" {{ $selectedYear==$year
                        ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                </select>
            </div>

            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2  flex-1 rounded">Filter</button>
        </form>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">User Registrations</h2>
            <canvas id="userChart"></canvas>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Payments</h2>
            <canvas id="paymentChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var userCtx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(userCtx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'User Registrations',
                data: @json($chartData),
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });

    var paymentCtx = document.getElementById('paymentChart').getContext('2d');
    var paymentChart = new Chart(paymentCtx, {
        type: 'bar',
        data: {
            labels: @json($paymentLabels),
            datasets: [{
                label: 'Payments ($)',
                data: @json($paymentAmounts),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });
</script>
@endsection