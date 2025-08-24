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
    <meta property="og:image" content="{{ asset('images/ristorante-preview.jpg') }}">
    <meta property="og:locale" content="it_IT">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Ristorante Buongusto | Cucina Italiana Autentica">
    <meta name="twitter:description" content="Autentica cucina italiana con ingredienti freschi, sapori tradizionali e atmosfera accogliente. Prenota ora!">
    <meta name="twitter:image" content="{{ asset('images/ristorante-preview.jpg') }}">
    
    <!-- Meta color -->
    <meta name="theme-color" content="#202938" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <x-navbar />
    {{$slot}}
</body>
</html>