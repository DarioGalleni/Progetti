@extends('components.layout')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <h2 class="fw-bold text-primary mb-4 text-center">Pulizie Camere</h2>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <form action="{{ route('cleaning.index') }}" method="GET" class="d-flex align-items-center gap-2">
                                    <label for="date" class="fw-bold text-nowrap">Data:</label>
                                    <input type="date" name="date" id="date" class="form-control"
                                        value="{{ $date->format('Y-m-d') }}" onchange="this.form.submit()">
                                </form>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('cleaning.print', ['date' => $date->format('Y-m-d')]) }}" target="_blank"
                                    class="btn btn-primary">
                                    <i class="bi bi-printer me-2"></i>Stampa
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 10%;">Camera</th>
                                        <th style="width: 25%;">Arrivo</th>
                                        <th style="width: 25%;">Partenza</th>
                                        <th style="width: 25%;">Fermo</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($rooms as $room => $name)
                                        @php
                                            $status = $roomStatus[$room] ?? null;
                                            if (empty($status['arrival']) && empty($status['departure']) && empty($status['stayover'])) {
                                                continue;
                                            }
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $room }}</strong></td>

                                            <td>
                                                @if(!empty($status['arrival']))
                                                    <span class="badge bg-success">✓ Arrivo ({{ $status['arrival']->pax }} pax)</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if(!empty($status['departure']))
                                                    <span class="badge bg-danger">✓ Partenza</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if(!empty($status['stayover']))
                                                    <span class="badge bg-info text-dark">✓ Fermo</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    @if(collect($roomStatus)->filter(fn($s) => !empty($s['arrival']) || !empty($s['departure']) || !empty($s['stayover']))->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                Nessuna camera da pulire per questa data
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection