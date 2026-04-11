<x-layout>
    <!-- Background Header that aligns with Navbar properly without overlap -->
    <header class="bg-dark text-white pt-5 pb-4"
        style="background-image: url('{{ asset('imgs/header.avif') }}'); background-blend-mode: overlay; background-color: rgba(0,0,0,0.8); background-position: center;">
        <div class="container pt-5 mt-5">
            <h1 class="display-5 fw-bold font-playfair mb-2">Ricerca Prenotazioni</h1>
            <p class="lead mb-0 text-white-50">Risultati per il numero: <strong>{{ $phone ?? '' }}</strong></p>
        </div>
    </header>

    <div class="container py-5 mt-4 min-vh-50">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-5 d-flex align-items-center gap-3"
                role="alert">
                <i data-lucide="check-circle" class="text-success"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($reservations->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($reservations as $res)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                            <div
                                class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">
                                    {{ \Carbon\Carbon::parse($res->date)->format('d/m/Y') }} h.
                                    {{ \Carbon\Carbon::parse($res->time)->format('H:i') }}
                                </span>

                                <form action="{{ route('reservations.destroy', $res->id) }}" method="POST"
                                    onsubmit="return confirm('Sei sicuro di voler cancellare la tua prenotazione?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-outline-danger btn-sm rounded-pill px-3 d-flex align-items-center gap-2">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i> Elimina
                                    </button>
                                </form>
                            </div>
                            <div class="card-body p-4 pt-3 text-center">
                                <h4 class="card-title fw-bold text-dark font-playfair mb-3">{{ $res->name }}</h4>
                                <a href="{{ route('reservations.show', $res->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-2">Vedi Dettagli</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 bg-light rounded-4 my-5 border shadow-sm">
                <i data-lucide="frown" class="text-secondary mb-3" style="width: 64px; height: 64px; opacity: 0.5;"></i>
                <h3 class="fw-bold font-playfair text-dark">Nessuna prenotazione trovata</h3>
                <p class="text-muted">Non abbiamo trovato prenotazioni associate al numero
                    <strong>{{ $phone ?? '' }}</strong>.</p>
                <a href="{{ url('/#reservation') }}" class="btn btn-primary rounded-pill mt-3 px-4 py-2">Fai una Nuova
                    Prenotazione</a>
            </div>
        @endif

    </div>
</x-layout>