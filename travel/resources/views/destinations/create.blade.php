<x-layout>

    <h1>Crea destinazione</h1>

    <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="destination">Nome destinazione</label>
            <input type="text" id="destination" name="destination" value="{{ old('destination') }}" required>
            @error('destination') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="duration">Durata (giorni)</label>
            <input type="number" id="duration" name="duration" value="{{ old('duration') }}" min="1" required>
            @error('duration') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="details">Dettagli</label>
            <textarea id="details" name="details">{{ old('details') }}</textarea>
            @error('details') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="price">Prezzo (€)</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" required>
            @error('price') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="image_path">Immagine</label>
            <input type="file" id="image_path" name="image_path" accept="image/*">
            @error('image_path') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Crea</button>
    </form>

</x-layout>