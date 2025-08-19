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

        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('articles.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cerca articoli per titolo..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cerca</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>