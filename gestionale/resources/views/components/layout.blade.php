<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#336633">
    <title>{{ $title ?? 'Gemma Hotel Management' }}</title>

    @php
        $isOnlineProd = str_contains(request()->url(), '/gest');
        $manifestExtrasPath = $isOnlineProd ? '/gest/manifest-extras.json' : asset('manifest-extras.json');
        $manifestMainPath = $isOnlineProd ? '/gest/manifest.json' : asset('manifest.json');
    @endphp

    @if(request()->is('*mobile/extras*'))
        <link rel="manifest" href="{{ $manifestExtrasPath }}">
    @else
        <link rel="manifest" href="{{ $manifestMainPath }}">
    @endif

    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="{{ $bodyId ?? '' }}" class="{{ $bodyClass ?? '' }}">
    @unless($hideNavbar ?? false)
        @include('components.navbar')
    @endunless

    <div class="container-fluid">

        {{ $slot ?? '' }}
        @yield('content')
    </div>

    {{ $scripts ?? '' }}
    @yield('scripts')

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