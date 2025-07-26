<x-layout>
@section('title', 'Benvenuto')
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="mt-5">
                @auth
                    Benvenuto nella tua applicazione Laravel, {{ auth()->user()->name }}!
                @else
                    Benvenuto nella tua applicazione Laravel!
                @endauth
            </h1>
            <p class="lead">Questa è la tua pagina di benvenuto.</p>
        </div>
    </div>
</div>
</x-layout>