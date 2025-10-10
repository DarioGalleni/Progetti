<div class="card-img-container fixed-image-container">
    <img src="{{ asset('media/destinations_images/' . $item->image_path) }}" class="card-img-top" alt="{{ $item->destination }}">
</div>
<div class="card-body">
    <h3 class="card-title">{{ $item->destination }}</h3>
    <p class="text-muted">
        <i class="fas fa-calendar-alt me-2"></i>{{ $item->duration }} giorni
    </p>
    <div class="price-tag">
        Prezzo: €{{ $item->price }}
    </div>
    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('destinations.show', $item) }}" class="btn btn-sm btn-primary" aria-label="Dettagli del viaggio a {{ $item->destination }}">
            Dettagli
        </a>
    </div>
</div>