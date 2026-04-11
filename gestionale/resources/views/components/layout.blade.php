<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if(request()->is('*mobile/extras*'))
        <link rel="manifest" href="{{ asset('manifest-extras.json') }}">
    @else
        <link rel="manifest" href="{{ asset('manifest.json') }}">
    @endif

    <meta name="theme-color" content="#336633">

    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <title>{{ $title ?? 'Gemma Hotel Management' }}</title>

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
                // Rileva se siamo online nella cartella /gest/ o in locale
                const isOnlineProd = window.location.pathname.includes('/gest');

                // Imposta i percorsi corretti dinamicamente
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