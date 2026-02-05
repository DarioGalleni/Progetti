<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="{{ asset($manifest ?? 'manifest.json') }}">
    <meta name="theme-color" content="#336633">
    <title>{{ $title ?? 'Gemma Hotel Management' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @unless($hideNavbar ?? false)
        @include('components.navbar')
    @endunless

    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </div>

    {{ $scripts ?? '' }}
    @yield('scripts')
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
</body>

</html>