<x-layout>
    <header class="bg-dark text-white pt-5 pb-4"
        style="background-image: url('{{ asset('imgs/header.avif') }}'); background-blend-mode: overlay; background-color: rgba(0,0,0,0.8); background-position: center;">
        <div class="container pt-5 mt-5">
            <h1 class="display-5 fw-bold font-playfair mb-2">Dettagli Prenotazione</h1>
            <p class="lead mb-0 text-white-50">#{{ $reservation->id }} - {{ $reservation->name }}</p>
        </div>
    </header>

    <div class="container py-5 mt-4 min-vh-50">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i data-lucide="calendar-check" class="text-primary mb-3"
                                style="width: 64px; height: 64px;"></i>
                            <h2 class="fw-bold font-playfair text-dark">Prenotazione Confermata</h2>
                        </div>

                        <ul class="list-group list-group-flush mb-4 fs-5">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center py-3 border-light">
                                <span class="text-muted"><i data-lucide="user" class="me-2" style="width: 20px;"></i>
                                    Nome:</span>
                                <span class="fw-bold">{{ $reservation->name }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center py-3 border-light">
                                <span class="text-muted"><i data-lucide="phone" class="me-2" style="width: 20px;"></i>
                                    Telefono:</span>
                                <span>{{ $reservation->phone }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center py-3 border-light">
                                <span class="text-muted"><i data-lucide="calendar" class="me-2"
                                        style="width: 20px;"></i> Data e Ora:</span>
                                <div>
                                    <span
                                        class="fw-bold">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</span>
                                    <span
                                        class="text-primary fw-bold ms-1">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</span>
                                </div>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center py-3 border-light">
                                <span class="text-muted"><i data-lucide="users" class="me-2" style="width: 20px;"></i>
                                    Ospiti:</span>
                                <span class="fw-bold">{{ $reservation->guests }} Persone</span>
                            </li>
                        </ul>

                        @if($reservation->message)
                            <div class="bg-light p-4 rounded-3 mb-4 border shadow-sm">
                                <h6 class="text-primary fw-bold mb-2">Note Addizionali:</h6>
                                <p class="mb-0 text-secondary fst-italic">{{ $reservation->message }}</p>
                            </div>
                        @endif

                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4">Torna
                                Indietro</a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                                onsubmit="return confirm('Sicuro di voler cancellare la prenotazione?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">Elimina
                                    Prenotazione</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>