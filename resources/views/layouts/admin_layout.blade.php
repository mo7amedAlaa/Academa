<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="{{ asset($settings['site_logo'] ?? 'logos/default-logo.png') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-100">
        <aside class="w-64 bg-white shadow-md ">
            <div class="p-6   font-bold text-xl border-b flex items-center  space-x-4">
                <img src="{{ asset($settings['site_logo'] ?? 'logos/default-logo.png') }}" alt="Admin Avatar"
                    class="w-12 h-12 rounded-lg">
                <p>
                    Admin Panel
                </p>
            </div>
            <div class="p-6 border-t border-gray-200 text-center">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset(auth()->user()->avatar) ?? asset('default-avatar.png') }}" alt="Admin Avatar"
                        class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-bold">{{ auth()->user()->name }}</p>
                        <p class="text-gray-500">Welcome back!</p>
                    </div>
                </div>
            </div>
            <ul class="mt-4">
                <li><a href="{{ route('admin.dashboard') }}" class="flex items-center p-4 hover:bg-gray-200">
                        <i class="fa-solid fa-chart-line mr-2"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.manage.users') }}" class="flex items-center p-4 hover:bg-gray-200">
                        <i class="fa-solid fa-users mr-2"></i> Users</a></li>
                <li><a href="{{ route('admin.manage.categories') }}" class="flex items-center p-4 hover:bg-gray-200">
                        <i class="fa-solid fa-layer-group mr-2"></i> Categories</a></li>
                <li><a href="{{ route('admin.manage.payments') }}" class="flex items-center p-4 hover:bg-gray-200">
                        <i class="fa-solid fa-money-check-alt mr-2"></i> Payments</a></li>
                <li><a href="{{ route('admin.reports') }}" class="flex items-center p-4 hover:bg-gray-200">
                        <i class="fa-solid fa-file-export mr-2"></i> Reports</a></li>
                <li><a href="{{ route('admin.settings') }}" class="flex items-center p-4 hover:bg-gray-200">
                        <i class="fa-solid fa-cog mr-2"></i> Settings</a></li>
                <li><a href="{{ route('admin.notifications') }}" class="flex items-center p-4 hover:bg-gray-200">
                        <i class="fa-solid fa-bell mr-2"></i>Notification</a></li>
                <li><a href="{{route('admin.profile')}}" class="flex items-center p-4 hover:bg-gray-200">
                        <i class="fa-solid fa-chalkboard-user mr-2"></i>profile</a></li>
                <li><a href="{{ route('logout') }}" class="flex items-center p-4 hover:bg-gray-200"><i
                            class="fa-solid fa-right-from-bracket mr-2"></i>
                        Logout</a></li>
            </ul>

        </aside>

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>
</body>

</html>