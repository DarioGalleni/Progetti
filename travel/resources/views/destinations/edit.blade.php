<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Modifica Destinazione</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="destination" class="form-label">Nome destinazione</label>
                                <input type="text" class="form-control @error('destination') is-invalid @enderror" 
                                    id="destination" name="destination" value="{{ old('destination', $destination->destination) }}" required>
                                @error('destination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="duration" class="form-label">Durata (giorni)</label>
                                <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                    id="duration" name="duration" value="{{ old('duration', $destination->duration) }}" min="1" required>
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="details" class="form-label">Dettagli</label>
                                <textarea class="form-control @error('details') is-invalid @enderror" 
                                    id="details" name="details" rows="4">{{ old('details', $destination->details) }}</textarea>
                                @error('details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Prezzo (€)</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                    id="price" name="price" value="{{ old('price', $destination->price) }}" step="0.01" min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($destination->image_path)
                                <div class="mb-3">
                                    <label class="form-label">Immagine attuale</label>
                                    <div class="card mb-2" style="max-width: 200px;">
                                        <img src="{{ route('images', ['filename' => $destination->image_path]) }}" 
                                            class="card-img-top" alt="{{ $destination->destination }}" style="max-height: 150px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="image_path" class="form-label">{{ $destination->image_path ? 'Cambia immagine' : 'Aggiungi immagine' }}</label>
                                <input type="file" class="form-control @error('image_path') is-invalid @enderror" 
                                    id="image_path" name="image_path" accept="image/*">
                                <div class="form-text">L'immagine deve essere di massimo 2MB</div>
                                @error('image_path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('destinations.index') }}" class="btn btn-secondary me-md-2">Annulla</a>
                                <button type="submit" class="btn btn-primary">Aggiorna Destinazione</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
