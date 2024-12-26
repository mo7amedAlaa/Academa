<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','academa')</title>
    <link rel="icon" href="{{ asset($settings['site_logo'] ?? 'logos/default-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js@1.11.2/src/toastify.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800 relative">
    @include('partials.welcomeHeader', ['searchResult' => $searchResult ?? null])
    @include('partials.mobile_header', ['searchResult' => $searchResult ?? null])

    <main class="flex-1 container mx-auto p-4">
        @yield('content')
    </main>
    @include('partials.Footer')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.11.2/src/toastify.min.js"></script>
</body>

</html>