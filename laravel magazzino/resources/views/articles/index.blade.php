<x-layout>
    @section('title', 'Tutti gli Articoli')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mt-5">Elenco Articoli</h1>
                <p class="lead">Ecco la lista di tutti gli articoli disponibili.</p>
            </div>  
        </div>
    </div>

<div class="container">
    <div class="row">
        @foreach ($items as $article)
            <div class="col-12 col-md-2 d-flex mb-4">
                <div class="card flex-fill d-flex flex-column">
                    <div class="card-img-top-container d-flex align-items-center justify-content-center p-2" style="height: 150px;">
                        <img src="{{ asset('storage/' . $article->item_image) }}" class="img-fluid rounded" style="max-height: 100%; object-fit: contain;" alt="Immagine Articolo">
                        {{-- <img src="{{ asset($article->item_image) }}" class="card-img-top img-fluid border p-1 rounded" alt="Immagine Articolo"> --}}
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text flex-grow-1">{{ $article->description }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info btn-sm">Vedi Dettagli</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                @if (session('warning'))
                    <div class="alert alert-warning mt-3">
                        {{ session('warning') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>          
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('createItem') }}" class="btn btn-primary mt-3">Crea Nuovo Articolo</a>
            </div>
        </div>

</x-layout>