<x-layout>
    <!-- Parallax Hero for Details -->
    <header class="parallax-section d-flex align-items-end"
        style="height: 60vh; background-image: url('{{ $journey->image }}'); background-position: center; background-repeat: no-repeat; background-size: cover;"
        role="banner">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-to-t from-black opacity-75"
            aria-hidden="true"></div>
        <div class="container position-relative z-index-1 text-white pb-5 reveal">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">
                <i class="bi bi-clock-history me-1"></i> {{ $journey->duration_days }} Giorni
            </span>
            <h1 class="display-2 fw-bold mb-2 text-shadow">{{ $journey->title }}</h1>
            <p class="fs-4 opacity-75">Un'esperienza indimenticabile ti aspetta</p>
        </div>
    </header>

    <div class="container py-5 section-padding">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8 animate-fade-in-up">
                <div class="bg-white p-4 rounded-4 shadow-sm mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h3 fw-bold mb-0 text-primary">Descrizione del Viaggio</h2>
                        @if($journey->images->count() > 0)
                            <a href="{{ route('journeys.gallery', $journey) }}"
                                class="btn btn-outline-primary rounded-pill px-4 fw-bold hover-scale me-2">
                                <i class="bi bi-images me-2"></i> Galleria
                            </a>
                        @endif
                        <a href="{{ route('journeys.edit', $journey) }}"
                            class="btn btn-outline-secondary rounded-pill px-4 fw-bold hover-scale me-2">
                            <i class="bi bi-pencil me-2"></i> Modifica
                        </a>
                        <form action="{{ route('journeys.destroy', $journey) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Sei sicuro di voler eliminare questo viaggio?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger rounded-pill px-4 fw-bold hover-scale">
                                <i class="bi bi-trash me-2"></i> Elimina
                            </button>
                        </form>
                    </div>

                    <p class="lead text-muted" style="text-align: justify; line-height: 1.8;">
                        {{ $journey->description }}
                    </p>

                    <hr class="my-5 opacity-10">

                    <h3 class="h4 fw-bold mb-3">Dettagli Incluso/Escluso</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h5 class="text-success small text-uppercase fw-bold mb-3"><i
                                    class="bi bi-check-circle-fill me-1"></i> Cosa è incluso</h5>
                            @if(is_array($journey->includes) && count($journey->includes) > 0)
                                <ul class="list-unstyled">
                                    @foreach($journey->includes as $item)
                                        <li class="mb-2 d-flex align-items-center">
                                            <i class="bi bi-check2 text-success me-2"></i> {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted small fst-italic">Nessuna informazione disponibile.</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-danger small text-uppercase fw-bold mb-3"><i
                                    class="bi bi-x-circle-fill me-1"></i> Cosa NON è incluso</h5>
                            @if(is_array($journey->excludes) && count($journey->excludes) > 0)
                                <ul class="list-unstyled">
                                    @foreach($journey->excludes as $item)
                                        <li class="mb-2 d-flex align-items-center">
                                            <i class="bi bi-x text-danger me-2"></i> {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted small fst-italic">Nessuna informazione disponibile.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Itinerary -->
                @if(is_array($journey->itinerary) && count($journey->itinerary) > 0)
                    <div class="bg-light p-4 rounded-4 shadow-sm reveal">
                        <h3 class="h4 fw-bold mb-4">Itinerario di Viaggio</h3>
                        <div class="accordion" id="itineraryAccordion">
                            @foreach($journey->itinerary as $index => $day)
                                <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }} fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#day{{ $index }}"
                                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}">
                                            Giorno {{ $index + 1 }} - {{ $day['title'] ?? 'Dettagli Giorno' }}
                                        </button>
                                    </h2>
                                    <div id="day{{ $index }}"
                                        class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                        data-bs-parent="#itineraryAccordion">
                                        <div class="accordion-body text-muted">
                                            {{ $day['description'] ?? 'Descrizione non disponibile.' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 animate-fade-in-up delay-1">
                <div class="sticky-top" style="top: 100px;">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-primary text-white p-4 text-center">
                            <h3 class="h5 mb-0 text-uppercase letter-spacing-1">Prenota Ora</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <span class="d-block text-muted text-uppercase small mb-1">Prezzo totale a
                                    persona</span>
                                <span
                                    class="display-4 fw-bold text-primary">€{{ number_format($journey->price, 0, ',', '.') }}</span>
                            </div>

                            <form>
                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-uppercase">Data di Partenza</label>
                                    <input type="date" class="form-control form-control-lg bg-light border-0">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-uppercase">Viaggiatori</label>
                                    <select class="form-select form-select-lg bg-light border-0">
                                        <option value="1">1 Adulto</option>
                                        <option value="2" selected>2 Adulti</option>
                                        <option value="3">3 Adulti</option>
                                        <option value="4">4 Adulti</option>
                                    </select>
                                </div>
                                <button type="button"
                                    class="btn btn-warning btn-lg w-100 rounded-pill fw-bold hover-scale shadow-sm">
                                    Richiedi Preventivo
                                </button>
                                <p class="text-center mt-3 small text-muted">
                                    <i class="bi bi-lock-fill"></i> Prenotazione sicura e senza impegno immediato
                                </p>
                            </form>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 bg-dark text-white p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box-modern bg-white text-primary me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h4 class="h6 mb-1 text-uppercase text-white-50">Hai domande?</h4>
                                <p class="mb-0 fw-bold fs-5">+39 06 123 4567</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>