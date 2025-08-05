<x-layout>
    @section('title', 'Crea Articolo')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mt-4 text-center">Crea Nuovo Articolo, <span class="text-primary">{{ $user->name }}</span></h1>

                @if (session('success'))
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6">
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
    <label for="price" class="form-label">Prezzo</label>
    <input type="number" class="form-control" id="price" name="price" required>
</div> <!-- Questa chiusura mancava -->

                    <div class="mb-3">
                        <label for="item_image" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="item_image" name="item_image" accept="image/*">
                    </div>
                    <div class="d-grid col-md-6 mx-auto">
                        <button type="submit" class="btn btn-primary">Crea Articolo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>