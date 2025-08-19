<x-layout>
    @section('title', 'Dettagli Articolo')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-lg p-4">
                    <div class="row g-4">
                        <div class="col-md-5 d-flex align-items-center justify-content-center">
                            @if ($item->item_image)
                                <div class="image-frame p-2 border rounded">
                                    <img src="{{ asset('storage/' . $item->item_image) }}" class="img-fluid rounded" alt="Immagine Articolo">
                                </div>
                            @else
                                <div class="text-center text-muted p-4 border rounded" style="width: 100%; height: 250px; display: flex; align-items: center; justify-content: center;">
                                    Nessuna immagine disponibile
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <h1 class="mb-3">Nome: {{ $item->title }}</h1>
                            <p class="lead">Descrizione: {{ $item->description }}</p>
                            <p class="lead">Prezzo: {{ $item->price }}</p>

                                <p class="text-muted mt-3">
                                    <small>Creato da: {{ $item->user->username ?? 'Utente Sconosciuto' }}</small>
                                </p>
                            <hr class="my-4">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Torna Indietro</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>