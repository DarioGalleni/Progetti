<x-layout>
    <!-- Background Section (reused from create for consistency) -->
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5 position-relative bg-dark"
        style="background-image: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=2021&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
        <!-- Overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>

        <div class="container position-relative z-index-1">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Glass Card -->
                    <div class="card border-0 rounded-4 overflow-hidden shadow-2xl animate-fade-in-up"
                        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px);">

                        <!-- Header -->
                        <div class="card-header bg-transparent border-0 p-5 pb-0 text-center">
                            <span
                                class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2 mb-3 fw-bold letter-spacing-1">
                                MODIFICA
                            </span>
                            <h1 class="display-5 fw-bold mb-2">Modifica Viaggio</h1>
                            <p class="text-muted">Aggiorna i dettagli di: <strong>{{ $journey->title }}</strong></p>
                        </div>

                        <div class="card-body p-5 pt-4">
                            <!-- Helper Text -->
                            <div
                                class="alert alert-info border-0 bg-info-subtle text-info-emphasis rounded-3 mb-4 d-flex align-items-center">
                                <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                                <div>
                                    <p class="mb-0 small">Stai modificando un viaggio esistente. I campi sono
                                        precompilati con i valori attuali.</p>
                                </div>
                            </div>

                            <!-- Error Message -->
                            @if ($errors->any())
                                <div class="alert alert-danger border-0 bg-danger-subtle text-danger rounded-3 mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-exclamation-triangle-fill fs-4 me-2"></i>
                                        <h6 class="fw-bold mb-0">Attenzione</h6>
                                    </div>
                                    <ul class="mb-0 small ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('journeys.update', $journey) }}" method="POST"
                                class="needs-validation" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <!-- Title Field -->
                                <div class="form-floating mb-4 reveal hover-lift">
                                    <input type="text" class="form-control border-0 bg-light rounded-3 fw-bold"
                                        id="title" name="title" value="{{ old('title', $journey->title) }}"
                                        placeholder="Titolo" style="height: 60px;" required>
                                    <label for="title" class="text-muted ps-4">Titolo del Viaggio</label>
                                </div>

                                <div class="row g-3 mb-4">
                                    <!-- Price Field -->
                                    <div class="col-md-6 reveal hover-lift" style="transition-delay: 0.1s;">
                                        <div class="form-floating input-group has-validation">
                                            <input type="number" step="0.01"
                                                class="form-control border-0 bg-light rounded-start-3 fw-bold"
                                                id="price" name="price" value="{{ old('price', $journey->price) }}"
                                                placeholder="0.00" style="height: 60px;" required>
                                            <span
                                                class="input-group-text border-0 bg-primary text-white px-4 fw-bold rounded-end-3">€</span>
                                            <label for="price" class="text-muted ps-4 z-index-1">Prezzo a
                                                persona</label>
                                        </div>
                                    </div>
                                    <!-- Duration Field -->
                                    <div class="col-md-6 reveal hover-lift" style="transition-delay: 0.2s;">
                                        <div class="form-floating">
                                            <input type="number"
                                                class="form-control border-0 bg-light rounded-3 fw-bold"
                                                id="duration_days" name="duration_days"
                                                value="{{ old('duration_days', $journey->duration_days) }}"
                                                placeholder="Giorni" style="height: 60px;" required>
                                            <label for="duration_days" class="text-muted ps-4">Durata (Giorni)</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Image Warning -->
                                <div class="mb-4 p-3 bg-light rounded-3 border border-secondary-subtle">
                                    <h6 class="fw-bold mb-2 small text-uppercase text-muted">Copertina Attuale</h6>
                                    <img src="{{ $journey->image }}" alt="Copertina attuale"
                                        class="img-fluid rounded-2 shadow-sm" style="max-height: 150px;">
                                    <input type="hidden" name="image" value="{{ $journey->image }}">
                                </div>

                                <!-- Description Field -->
                                <div class="form-floating mb-5 reveal hover-lift" style="transition-delay: 0.4s;">
                                    <textarea class="form-control border-0 bg-light rounded-3" id="description"
                                        name="description" placeholder="Descrizione"
                                        style="height: 150px; resize: none;"
                                        required>{{ old('description', $journey->description) }}</textarea>
                                    <label for="description" class="text-muted ps-4">Descrizione emozionale e
                                        dettagliata</label>
                                </div>

                                <!-- Actions -->
                                <div class="d-flex justify-content-between align-items-center pt-3 reveal"
                                    style="transition-delay: 0.5s;">
                                    <a href="{{ route('journeys.show', $journey) }}"
                                        class="btn btn-link text-muted text-decoration-none px-0 hover-translate-start">
                                        <i class="bi bi-arrow-left me-1"></i> Annulla
                                    </a>
                                    <button type="submit"
                                        class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-scale">
                                        <i class="bi bi-save-fill me-2"></i> Salva Modifiche
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout>