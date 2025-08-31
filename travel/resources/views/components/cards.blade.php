
<img src="{{ route('destination.image', ['filename' => $item->image_path]) }}" class="card-img-top" alt="{{ $item->destination }}">
<div class="card-body">
    <h3 class="card-title">{{ $item->destination }}</h3>
    <p class="text-muted">
        <i class="fas fa-calendar-alt me-2"></i>{{ $item->duration }} giorni
    </p>
    <div class="price-tag">
        Prezzo: €{{ $item->price }}
    </div>
    <a href="#" class="btn btn-sm btn-primary" aria-label="Dettagli del viaggio a Bali">
        Dettagli
    </a>
</div>