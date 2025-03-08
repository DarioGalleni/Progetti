<x-layout>
    @section('title', 'Dettagli')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Dettagli di {{$guests->name}}</h1>

                <img class="img-fluid" src="{{ asset('img/' . $guests->img) }}" alt="Immagine utente">
            </div>
        </div>
    </div>
</x-layout>