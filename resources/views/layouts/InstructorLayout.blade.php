<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Academa')</title>

    <link rel="icon" href="{{ asset('public/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen">

    <main class="flex-1 container mx-auto p-4">
        @yield('content')
    </main>
    @include('partials.Footer')
</body>

</html>
