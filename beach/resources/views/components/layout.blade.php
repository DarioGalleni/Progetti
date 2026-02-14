<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta name="theme-color" content="#00A3C4">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Titolo Predefinito')</title>
</head>

<body class="beach-theme">
    <x-navbar />
    <main class="py-3">
        {{$slot}}
    </main>

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                const isOnlineProd = window.location.pathname.includes('/gest');
                const swPath = isOnlineProd ? '/gest/sw.js' : '/sw.js';
                const swScope = isOnlineProd ? '/gest/' : '/';
                navigator.serviceWorker.register(swPath, { scope: swScope })
                    .then((reg) => console.log('SW registrato su:', reg.scope))
                    .catch((err) => console.log('SW errore:', err));
            });
        }
    </script>
</body>

</html>