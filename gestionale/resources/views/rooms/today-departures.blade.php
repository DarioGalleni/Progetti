<x-layout>
    <div class="container py-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white border-bottom border-light pt-4 pb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <h4 class="mb-0 text-dark fw-bold">
                        <i class="fas fa-hotel me-2"></i><span class="text-primary">Stato Camere</span>
                    </h4>

                    <form method="GET" action="{{ route('rooms.todayDepartures') }}"
                        class="d-flex align-items-center gap-2">
                        <input type="date"
                            class="form-control form-control-lg border-primary shadow-sm fw-bold text-primary" id="date"
                            name="date" value="{{ $today->format('Y-m-d') }}" onchange="this.form.submit()"
                            style="min-width: 200px;">
                    </form>

                    <div>
                        <a href="{{ route('rooms.todayDepartures.print', ['date' => $today->format('Y-m-d')]) }}"
                            target="_blank" class="btn btn-outline-primary me-2">
                            <i class="fas fa-print me-1"></i>Stampa
                        </a>
                        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Indietro
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                @if(empty($roomStatus))
                    <div class="alert alert-info shadow-sm border-0 d-flex align-items-center" role="alert">
                        <i class="fas fa-info-circle me-3 fs-4"></i>
                        <div>
                            Nessuna camera in arrivo, in partenza o in fermo per oggi.
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="py-3">Numero Camera</th>
                                    <th scope="col" class="py-3">In Partenza</th>
                                    <th scope="col" class="py-3">In Arrivo</th>
                                    <th scope="col" class="py-3">In Fermo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roomStatus as $room => $status)
                                    <tr>
                                        <td class="fw-bold fs-5">{{ $room }}</td>
                                        <td>
                                            @if(!empty($status['departing']))
                                                <i class="fas fa-check text-danger fs-4"></i>
                                            @else
                                                <span class="text-muted opacity-25">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($status['arriving']))
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <i class="fas fa-check text-success fs-4"></i>
                                                    @if(isset($status['arriving_pax']) && $status['arriving_pax'] > 0)
                                                        <span
                                                            class="badge bg-success bg-opacity-10 text-success rounded-pill border border-success px-2">
                                                            {{ $status['arriving_pax'] }} <i class="fas fa-user-friends ms-1 small"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted opacity-25">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($status['staying']))
                                                <i class="fas fa-check text-primary fs-4"></i>
                                            @else
                                                <span class="text-muted opacity-25">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>