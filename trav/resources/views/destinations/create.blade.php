<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="my-4">Aggiungi Destinazione</h3>
            </div>
        </div>
    </div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('destinations.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="destination" class="form-label">Nome Destinazione</label>
                    <input type="text" class="form-control" id="destination" name="destination" required>
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Durata (es. 7 giorni)</label>
                    <input type="text" class="form-control" id="duration" name="duration" required>
                </div>

                <div class="mb-3">
                    <label for="details" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="details" name="details" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo (€)</label>
                    <input type="number" class="form-control" id="price" name="price" required min="0">
                </div>

                <div class="mb-3">
                    <label for="image_path" class="form-label">Immagine</label>
                    <input type="file" class="form-control" id="image_path" name="image_path" required>
                </div>

                <button type="submit" class="btn btn-primary">Aggiungi Destinazione</button>
            </form>
        </div>
    </div>
</div>
</x-layout>