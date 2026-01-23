<x-layout>
    <div class="bg-black min-vh-100 text-white py-5 font-monospace">
        <div class="container">
            <!-- Header -->
            <div class="row mb-5 border-bottom border-secondary pb-3 align-items-end">
                <div class="col-md-8">
                    <span class="badge bg-secondary text-dark rounded-0 mb-2">BACKOFFICE</span>
                    <h1 class="display-5 fw-bold text-white mb-0 text-uppercase">Nuova Avventura</h1>
                </div>
                <div class="col-md-4 text-md-end text-secondary small">
                    DASHBOARD OPERATIVA
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success bg-transparent text-success border-success rounded-0 d-flex align-items-center mb-4"
                    role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger bg-transparent text-danger border-danger rounded-0 mb-4" role="alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <span class="fw-bold">ATTENZIONE</span>
                    </div>
                    <ul class="mb-0 small ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('journeys.store') }}" method="POST" enctype="multipart/form-data" novalidate
                class="needs-validation">
                @csrf

                <!-- Grid -->
                <div class="row g-5">
                    <!-- Left Column: inputs -->
                    <div class="col-lg-8">

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title"
                                class="form-label text-secondary small fw-bold letter-spacing-1 text-uppercase">Titolo
                                Viaggio</label>
                            <input type="text"
                                class="form-control bg-dark text-white border-secondary rounded-0 p-3 fs-5 focus-ring-light"
                                id="title" name="title" value="{{ old('title') }}" placeholder="Inserisci il titolo..."
                                required>
                        </div>

                        <div class="row g-4 mb-4">
                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price"
                                    class="form-label text-secondary small fw-bold letter-spacing-1 text-uppercase">Prezzo
                                    (€)</label>
                                <input type="number" step="0.01"
                                    class="form-control bg-dark text-white border-secondary rounded-0 p-3 fs-5"
                                    id="price" name="price" value="{{ old('price') }}" placeholder="0.00" required>
                            </div>
                            <!-- Duration -->
                            <div class="col-md-6">
                                <label for="duration_days"
                                    class="form-label text-secondary small fw-bold letter-spacing-1 text-uppercase">Durata
                                    (Giorni)</label>
                                <input type="number"
                                    class="form-control bg-dark text-white border-secondary rounded-0 p-3 fs-5"
                                    id="duration_days" name="duration_days" value="{{ old('duration_days') }}"
                                    placeholder="0" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description"
                                class="form-label text-secondary small fw-bold letter-spacing-1 text-uppercase">Descrizione</label>
                            <textarea class="form-control bg-dark text-white border-secondary rounded-0 p-3"
                                id="description" name="description" rows="10"
                                placeholder="Scrivi una descrizione dettagliata..."
                                required>{{ old('description') }}</textarea>
                        </div>

                    </div>

                    <!-- Right Column: Images -->
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label for="images"
                                class="form-label text-secondary small fw-bold letter-spacing-1 text-uppercase">Galleria
                                & Copertina</label>
                            <input type="file" class="form-control bg-dark text-white border-secondary rounded-0 mb-3"
                                id="images" name="images[]" multiple accept="image/*" required>
                            <div class="form-text text-secondary mb-3 small">
                                <i class="bi bi-info-circle me-1"></i> Carica le foto e seleziona la copertina.
                            </div>

                            <!-- Hidden input for cover index -->
                            <input type="hidden" name="cover_image_index" id="coverImageIndex" value="0">

                            <!-- Preview Container -->
                            <div id="imagePreviewContainer" class="row g-2">
                                <!-- Previews will be injected here via JS -->
                            </div>
                        </div>
                        <!-- Details: Includes & Excludes -->
                        <div class="row g-4 mb-4">
                            <!-- Includes -->
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary small fw-bold letter-spacing-1 text-uppercase">Cosa
                                    è incluso</label>
                                <div id="includes-container">
                                    <div class="input-group mb-2">
                                        <input type="text"
                                            class="form-control bg-dark text-white border-secondary rounded-0 p-2"
                                            name="includes[]" placeholder="Es. Voli A/R">
                                        <button type="button" class="btn btn-outline-secondary rounded-0"
                                            onclick="removeItem(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary rounded-0 text-uppercase mt-1"
                                    onclick="addItem('includes-container', 'includes[]')">
                                    <i class="bi bi-plus-lg me-1"></i> Aggiungi voce
                                </button>
                            </div>

                            <!-- Excludes -->
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary small fw-bold letter-spacing-1 text-uppercase">Cosa
                                    NON è incluso</label>
                                <div id="excludes-container">
                                    <div class="input-group mb-2">
                                        <input type="text"
                                            class="form-control bg-dark text-white border-secondary rounded-0 p-2"
                                            name="excludes[]" placeholder="Es. Mance">
                                        <button type="button" class="btn btn-outline-secondary rounded-0"
                                            onclick="removeItem(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary rounded-0 text-uppercase mt-1"
                                    onclick="addItem('excludes-container', 'excludes[]')">
                                    <i class="bi bi-plus-lg me-1"></i> Aggiungi voce
                                </button>
                            </div>
                        </div>

                        <!-- Itinerary -->
                        <div class="mb-5">
                            <label
                                class="form-label text-secondary small fw-bold letter-spacing-1 text-uppercase mb-3">Itinerario
                                Giornaliero</label>
                            <div id="itinerary-container">
                                <!-- Day 1 -->
                                <div class="card bg-dark border-secondary mb-3 itinerary-day">
                                    <div
                                        class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center">
                                        <span class="text-white small text-uppercase fw-bold">Giorno <span
                                                class="day-number">1</span></span>
                                        <button type="button" class="btn btn-sm text-secondary hover-text-danger p-0"
                                            onclick="removeDay(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <input type="text"
                                                class="form-control bg-black text-white border-secondary rounded-0 mb-2"
                                                name="itinerary[0][title]"
                                                placeholder="Titolo del giorno (es. Arrivo a Roma)" required>
                                        </div>
                                        <div>
                                            <textarea
                                                class="form-control bg-black text-white border-secondary rounded-0"
                                                name="itinerary[0][description]" rows="3"
                                                placeholder="Descrizione delle attività..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-light w-100 rounded-0 text-uppercase py-2"
                                onclick="addDay()">
                                <i class="bi bi-plus-lg me-2"></i> Aggiungi Giorno
                            </button>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div
                        class="col-12 border-top border-secondary pt-4 mt-2 d-flex justify-content-between align-items-center">
                        <a href="{{ route('journeys.index') }}"
                            class="text-secondary text-decoration-none small text-uppercase hover-text-white">
                            <i class="bi bi-arrow-left me-1"></i> Torna alla lista
                        </a>
                        <button type="submit"
                            class="btn btn-light rounded-0 px-5 py-3 fw-bold text-uppercase border-0 hover-scale">
                            Pubblica Viaggio
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>