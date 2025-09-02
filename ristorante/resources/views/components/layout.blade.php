<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ristorante Buongusto | Cucina Italiana Autentica</title>

    <!-- Meta SEO -->
    <meta name="description" content="Ristorante Buongusto offre autentica cucina italiana a Roma con ingredienti freschi e sapori tradizionali. Prenota ora per un'esperienza culinaria indimenticabile.">
    <meta name="keywords" content="ristorante italiano, cucina italiana, Roma, pasta fresca, prenotazione ristorante, Buongusto, menu italiano, antipasti, primi piatti">
    <meta name="author" content="Ristorante Buongusto">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Ristorante Buongusto | Cucina Italiana Autentica">
    <meta property="og:description" content="Autentica cucina italiana con ingredienti freschi, sapori tradizionali e atmosfera accogliente. Prenota ora!">
    <meta property="og:image" content="{{ route('restaurant.image', ['filename' => 'home-section.jpg']) }}">
    <meta property="og:locale" content="it_IT">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Ristorante Buongusto | Cucina Italiana Autentica">
    <meta name="twitter:description" content="Autentica cucina italiana con ingredienti freschi, sapori tradizionali e atmosfera accogliente. Prenota ora!">
    <meta name="twitter:image" content="{{ route('restaurant.image', ['filename' => 'home-section.jpg']) }}">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-57x57.png']) }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-60x60.png']) }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-72x72.png']) }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-76x76.png']) }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-114x114.png']) }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-120x120.png']) }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-144x144.png']) }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-152x152.png']) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ route('restaurant.image', ['filename' => 'favicon/apple-icon-180x180.png']) }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ route('restaurant.image', ['filename' => 'favicon/android-icon-192x192.png']) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ route('restaurant.image', ['filename' => 'favicon/favicon-32x32.png']) }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ route('restaurant.image', ['filename' => 'favicon/favicon-96x96.png']) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ route('restaurant.image', ['filename' => 'favicon/favicon-16x16.png']) }}">
    <link rel="manifest" href="{{ route('restaurant.image', ['filename' => 'favicon/manifest.json']) }}">
    <meta name="msapplication-TileColor" content="#202938">
    <meta name="msapplication-TileImage" content="{{ route('restaurant.image', ['filename' => 'favicon/ms-icon-144x144.png']) }}">

    <!-- Meta color -->
    <meta name="theme-color" content="#202938" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <x-navbar />
    {{ $slot }}
</body>
</html>
