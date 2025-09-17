<x-layout>
    @section('title', 'Ristorante')
    <div class="container-fluid mt-5">
        <h1 class="mb-4 text-center">
            Ristorante - {{ \Carbon\Carbon::parse($selectedDate)->locale('it')->isoFormat('D MMMM YYYY') }}
        </h1>

        <!-- Selettore data -->
        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <form method="GET" action="{{ route('customers.restaurant') }}" class="d-flex">
                    <input 
                        type="date" 
                        name="date" 
                        class="form-control me-2" 
                        value="{{ $selectedDate->format('Y-m-d') }}"
                    >
                    <button type="submit" class="btn btn-primary">Visualizza</button>
                </form>
            </div>
        </div>

        @if(empty($roomData))
            <div class="alert alert-info" role="alert">
                Nessuna camera occupata per la data selezionata.
            </div>
        @else
            <table class="table table-bordered text-center">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Numero Camera</th>
                        <th scope="col">Numero Persone</th>
                        <th scope="col">Colazione</th>
                        <th scope="col">Cena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roomData as $roomNumber => $data)
                        <tr>
                            <td class="fw-bold align-middle">{{ $roomNumber }}</td>
                            <td class="align-middle">{{ $data['number_of_people'] }}</td>
                            <td class="align-middle">
                                @if($data['breakfast'])
                                    <span class="text-success fs-4 fw-bold">&#10003;</span>
                                @else
                                    <small class="text-muted">-</small>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if($data['dinner'])
                                    <span class="text-primary fs-4 fw-bold">&#10003;</span>
                                    @if($data['status'] === 'arriving' || ($data['status'] === 'departing_arriving' && isset($data['arriving_people'])))
                                        <small class="text-muted ms-2">
                                            ({{ $data['status'] === 'departing_arriving' ? $data['arriving_people'] : $data['number_of_people'] }} in arrivo)
                                        </small>
                                    @endif
                                @else
                                    <small class="text-muted">-</small>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-light">
                    <tr>
                        <th>Totali</th>
                        <th>
                            {{ array_sum(array_column($roomData, 'number_of_people')) }} persone
                        </th>
                        <th>
                            {{ array_sum(array_map(function($data) { return $data['breakfast'] ? $data['number_of_people'] : 0; }, $roomData)) }} persone
                        </th>
                        <th>
                            @php
                                $totalDinnerPeople = 0;
                                foreach($roomData as $data) {
                                    if($data['dinner']) {
                                        if($data['status'] === 'departing_arriving' && isset($data['arriving_people'])) {
                                            $totalDinnerPeople += $data['arriving_people'];
                                        } else {
                                            $totalDinnerPeople += $data['number_of_people'];
                                        }
                                    }
                                }
                            @endphp
                            {{ $totalDinnerPeople }} persone
                        </th>
                    </tr>
                </tfoot>
            </table>

        @endif
        
        <div class="mt-4 d-flex justify-content-center">
            <a href="{{ route('welcome') }}" class="btn btn-primary">Torna al Calendario</a>
        </div>
    </div>
</x-layout>