<x-layout title="Galleria - {{ $journey->title }}">
    <div class="bg-black min-vh-100 d-flex flex-column justify-content-center pt-5">
        <div class="container py-5">
            <!-- Header con pulsante indietro -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('journeys.show', $journey) }}"
                    class="btn btn-outline-light rounded-pill px-4 hover-scale text-uppercase font-bold tracking-wider">
                    <i class="bi bi-arrow-left me-2"></i> Torna ai Dettagli
                </a>
                <h1 class="h4 text-white-50 mb-0 d-none d-md-block">{{ $journey->title }} <span
                        class="text-white">Gallery</span></h1>
            </div>

            <!-- Carosello Immagini -->
            <div id="galleryCarousel"
                class="carousel slide shadow-2xl rounded-4 overflow-hidden border border-secondary border-opacity-25"
                data-bs-ride="true">

                @if($journey->images->count() > 1)
                    <div class="carousel-indicators mb-4">
                        @foreach($journey->images as $index => $image)
                            <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                @endif

                <div class="carousel-inner bg-dark">
                    @foreach($journey->images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" style="height: 75vh;">
                            <!-- NOTA: Assicurati che il path sia accessibile pubblicamente o usa un helper dedicato -->
                            <img src="{{ Storage::url($image->path) }}" class="d-block w-100 h-100"
                                style="object-fit: contain;" alt="Foto {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>

                @if($journey->images->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"
                            style="width: 4rem; height: 4rem; filter: drop-shadow(0 0 10px rgba(0,0,0,0.8));"></span>
                        <span class="visually-hidden">Precedente</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"
                            style="width: 4rem; height: 4rem; filter: drop-shadow(0 0 10px rgba(0,0,0,0.8));"></span>
                        <span class="visually-hidden">Successivo</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</x-layout>