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
    @include('partials.Header', ['searchResult' => $searchResult ?? null])
    <main class="flex-1 container mx-auto p-4">
        @yield('content')
    </main>
    @include('partials.Footer')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('527999efd823bd11e33e', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            alert(JSON.stringify(data));
        });
    </script>
</body>

</html>