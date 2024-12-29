@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto p-6 max-w-screen-xl">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Reports</h1>

    <!-- Filter Options -->
    <form action="{{ route('admin.reports') }}" method="GET" class="mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label for="report_type" class="block text-gray-700">Report Type</label>
                <select id="report_type" name="report_type"
                    class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="users" {{ request('report_type')=='users' ? 'selected' : '' }}>User Report</option>
                    <option value="courses" {{ request('report_type')=='courses' ? 'selected' : '' }}>Course Report
                    </option>
                    <option value="stats" {{ request('report_type')=='stats' ? 'selected' : '' }}>General Statistics
                    </option>
                </select>
            </div>
            <div>
                <label for="start_date" class="block text-gray-700">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                    class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
            </div>
            <div>
                <label for="end_date" class="block text-gray-700">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                    class="mt-1 p-2 w-full border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none">
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                View Report
            </button>
        </div>
    </form>

    <!-- Report Data -->
    @if(isset($data))
    <div class="bg-white p-6 shadow-md rounded-lg">
        <h2 class="text-xl font-bold mb-4">Report Results</h2>
        <table class="min-w-full border border-gray-300 table-auto">
            <thead>
                <tr class="bg-gray-100">
                    @foreach($headers as $header)
                    <th class="border-b border-gray-300 px-4 py-2 text-left">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr class="hover:bg-gray-50 transition duration-300">
                    @foreach($row as $value)
                    <td class="border-b border-gray-300 px-4 py-2">{{ $value }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6 flex justify-between">
            <a href="{{ route('admin.reports.export', ['type' => request('report_type'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600 transition duration-300 transform hover:scale-105">
                Export as Excel
            </a>
            <a href="{{ route('admin.reports.export-pdf', ['type' => request('report_type'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                class="px-6 py-3 bg-red-500 text-white rounded hover:bg-red-600 transition duration-300 transform hover:scale-105">
                Export as PDF
            </a>
        </div>
    </div>
    @else
    <div class="p-4 bg-yellow-100 text-yellow-700 rounded">
        Please select a report type and enter a date range to get the results.
    </div>
    @endif

</div>
@endsection