<x-layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card shadow mb-4">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ route('images', ['filename' => $destination->image_path]) }}" 
                                class="img-fluid rounded-start h-100 w-100" style="object-fit: cover;" 
                                alt="{{ $destination->destination }}">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h2 class="card-title">{{ $destination->destination }}</h2>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge bg-primary me-2">{{ $destination->duration }}@if(is_numeric($destination->duration)) giorni @endif</span>
                                    <span class="badge bg-success">€{{ $destination->price }}</span>
                                </div>
                                
                                <h5 class="card-subtitle mb-2 text-muted">Dettagli del viaggio</h5>
                                <p class="card-text">{{ $destination->details }}</p>
                                
                                <div class="d-flex mt-4">
                                    <a href="{{ route('destinations.edit', $destination) }}" class="btn btn-primary me-2">
                                        <i class="bi bi-pencil"></i> Modifica
                                    </a>
                                    <form action="{{ route('destinations.destroy', $destination) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa destinazione?')">
                                            <i class="bi bi-trash"></i> Elimina
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
