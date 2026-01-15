<x-layout>
    <div class="container py-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white border-bottom border-light pt-4 pb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <h4 class="mb-0 text-dark fw-bold">
                        <i class="fas fa-utensils me-2"></i><span class="text-primary">Ristorante</span>
                    </h4>

                    <form action="{{ route('customers.restaurant') }}" method="GET"
                        class="d-flex align-items-center gap-2">
                        <input type="date" name="date" id="date"
                            class="form-control form-control-lg border-primary shadow-sm fw-bold text-primary"
                            value="{{ $selectedDate->format('Y-m-d') }}" onchange="this.form.submit()"
                            style="min-width: 200px;">
                    </form>

                    <div>
                        <a href="{{ route('customers.restaurant.print', ['date' => $selectedDate->format('Y-m-d')]) }}"
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
                @php
                    $totalBreakfast = 0;
                    $totalDinner = 0;
                    foreach ($roomData as $data) {
                        if ($data['breakfast']) {
                            $totalBreakfast += $data['number_of_people'];
                        }
                        if ($data['dinner']) {
                            if (isset($data['arriving_people'])) {
                                $totalDinner += $data['arriving_people'];
                            } elseif ($data['status'] === 'arriving') {
                                $totalDinner += $data['number_of_people'];
                            } else {
                                $totalDinner += $data['number_of_people'];
                            }
                        }
                    }
                @endphp
                @if(empty($roomData))
                    <div class="alert alert-info shadow-sm border-0 d-flex align-items-center" role="alert">
                        <i class="fas fa-info-circle me-3 fs-4"></i>
                        <div>
                            Nessun ospite presente per la data selezionata.
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="py-3" style="width: 20%;">Camera</th>
                                    <th scope="col" class="py-3" style="width: 20%;">Pax</th>
                                    <th scope="col" class="py-3"><i class="fas fa-coffee me-2"></i>Colazione
                                    </th>
                                    <th scope="col" class="py-3"><i class="fas fa-utensils me-2"></i>Cena</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roomData as $room => $data)
                                    <tr>
                                        <td class="fw-bold fs-5">{{ $room }}</td>

                                        {{-- Colonna Pax --}}
                                        <td>
                                            <span class="fw-bold">{{ $data['number_of_people'] }}</span>
                                            @if(isset($data['arriving_people']))
                                                <span class="text-success small ms-1">
                                                    <i class="fas fa-arrow-left me-1"></i>{{ $data['arriving_people'] }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Colonna Colazione --}}
                                        <td>
                                            @if($data['breakfast'])
                                                <i class="fas fa-check text-success fs-5"></i>
                                            @else
                                                <span class="text-muted opacity-25">-</span>
                                            @endif
                                        </td>

                                        {{-- Colonna Cena --}}
                                        <td>
                                            @if($data['dinner'])
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <i class="fas fa-check text-success fs-5"></i>
                                                    @if($data['status'] === 'arriving')
                                                        {{-- Arrivo HB: Mostra Pax in arrivo --}}
                                                        <span class="badge bg-success rounded-pill fs-6 px-2">
                                                            In Arrivo: {{ $data['number_of_people'] }} <i class="fas fa-user ms-1"></i>
                                                        </span>
                                                    @elseif($data['status'] === 'departing_arriving' && isset($data['arriving_people']))
                                                        {{-- Cambio Camera HB: Mostra Pax in arrivo --}}
                                                        <span class="badge bg-success rounded-pill fs-6 px-2">
                                                            In Arrivo: {{ $data['arriving_people'] }} <i class="fas fa-user ms-1"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted opacity-25">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <td colspan="2" class="text-center pe-3">Totali:</td>
                                    <td class="fs-5">{{ $totalBreakfast }}</td>
                                    <td class="fs-5">{{ $totalDinner }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif


            </div>
        </div>
    </div>
</x-layout>