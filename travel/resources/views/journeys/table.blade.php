<x-layout>
    <div class="bg-black min-vh-100 text-white py-5 font-monospace">
        <div class="container">
            <!-- Header -->
            <div class="row mb-5 border-bottom border-secondary pb-3 align-items-end">
                <div class="col-md-8">
                    <span class="badge bg-secondary text-dark rounded-0 mb-2">BACKOFFICE</span>
                    <h1 class="display-5 fw-bold text-white mb-0 text-uppercase">Gestione Viaggi</h1>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="text-secondary small mb-2">DASHBOARD OPERATIVA</div>
                    <a href="{{ route('journeys.create') }}"
                        class="btn btn-light rounded-0 text-uppercase fw-bold px-4 hover-scale border-0">
                        <i class="bi bi-plus-lg me-2"></i> Nuovo
                    </a>
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

            <!-- Table Container -->
            <div class="border border-secondary">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0 align-middle">
                        <thead>
                            <tr class="border-secondary">
                                <th scope="col"
                                    class="bg-transparent border-secondary text-secondary text-uppercase py-3 ps-4 small"
                                    style="width: 80px;">ID</th>
                                <th scope="col"
                                    class="bg-transparent border-secondary text-secondary text-uppercase py-3 small">
                                    Viaggio</th>
                                <th scope="col"
                                    class="bg-transparent border-secondary text-secondary text-uppercase py-3 small text-end pe-4"
                                    style="width: 250px;">Azioni</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($journeys as $journey)
                                <tr class="border-secondary">
                                    <td class="bg-transparent border-secondary ps-4 fw-bold text-secondary">
                                        #{{ $journey->id }}</td>
                                    <td class="bg-transparent border-secondary">
                                        <div class="d-flex align-items-center py-2">
                                            @if($journey->image)
                                                <div class="ratio ratio-16x9 me-3 border border-secondary" style="width: 80px;">
                                                    <img src="{{ $journey->image }}" class="object-fit-cover" alt="Thumb">
                                                </div>
                                            @else
                                                <div class="me-3 bg-secondary bg-opacity-10 border border-secondary d-flex align-items-center justify-content-center"
                                                    style="width: 80px; height: 45px;">
                                                    <i class="bi bi-image text-secondary"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold text-white mb-1">{{ $journey->title }}</div>
                                                <div class="small text-secondary text-uppercase">
                                                    {{ $journey->duration_days }} Giorni &bull;
                                                    €{{ number_format($journey->price, 0) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bg-transparent border-secondary text-end pe-4">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('journeys.show', $journey) }}"
                                                class="btn btn-sm btn-outline-secondary rounded-0" title="Anteprima">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('journeys.edit', $journey) }}"
                                                class="btn btn-sm btn-outline-light rounded-0" title="Modifica">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('journeys.destroy', $journey) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('CONFERMA ELIMINAZIONE\n\nStai per cancellare definitivamente il viaggio:\n{{ addslashes($journey->title) }}\n\nProcedere?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-0 border-start-0"
                                                    title="Elimina">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-secondary border-0">
                                        <i class="bi bi-folder2-open display-4 d-block mb-3 opacity-50"></i>
                                        NESSUN VIAGGIO TROVATO
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Link -->
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('journeys.index') }}"
                    class="text-secondary text-decoration-none small text-uppercase hover-text-white arrow-link">
                    <i class="bi bi-arrow-left me-1"></i> Torna al sito pubblico
                </a>
                <div class="text-secondary small">
                    TOTALE RECORDS: {{ $journeys->count() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>