<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Academa')</title>

    <link rel="icon" href="{{ asset($settings['site_logo'] ?? 'logos/default-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include Toastify CSS -->



    @vite('resources/css/app.css')
</head>
@if(session('error'))
<script>
    window.addEventListener('DOMContentLoaded', function () {
        Toastify({
            text: "{{ session('error') }}",
            backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
            close: true,
            position: "top-center",
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
            position: "top-center",
            duration: 3000
        }).showToast();
    });
</script>
@endif

<body class="flex flex-col min-h-screen ">
    <main class="flex-1 container mx-auto p-4">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js@1.11.2/src/toastify.min.css">


        @yield('content')
    </main>
    @include('partials.Footer')
    <!-- Include Toastify JS -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.11.2/src/toastify.min.js"></script>
</body>

</html>