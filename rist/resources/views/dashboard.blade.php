<x-layout>
    <style>
        body {
            background-color: #000 !important;
            color: #fff !important;
        }
        
        .dashboard-container {
            background-color: #000;
            min-height: 100vh;
            padding-top: 120px;
            color: #fff;
        }

        .table-dark-custom {
            background-color: #111;
            color: #fff;
            border-color: #333;
        }

        .table-dark-custom th {
            background-color: #222;
            color: #ccc;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            border-color: #333;
        }

        .table-dark-custom td {
            border-color: #333;
            vertical-align: middle;
        }

        .btn-contrast {
            background-color: #fff;
            color: #000;
            font-weight: bold;
            border: 2px solid #fff;
        }

        .btn-contrast:hover {
            background-color: #000;
            color: #fff;
        }

        .btn-outline-contrast {
            background-color: transparent;
            color: #fff;
            border: 2px solid #fff;
            font-weight: bold;
        }

        .btn-outline-contrast:hover {
            background-color: #fff;
            color: #000;
        }

        .date-navigator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .date-input {
            background-color: #111;
            color: #fff;
            border: 1px solid #444;
            padding: 8px 15px;
            border-radius: 5px;
            color-scheme: dark;
            font-size: 1.1rem;
            text-align: center;
        }

        .section-title {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .status-badge {
            background-color: #fff;
            color: #000;
            font-weight: bold;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        /* Navbar scura sempre per la dashboard */
        .navbar {
            background-color: #000 !important;
            border-bottom: 1px solid #333;
        }
    </style>

    <div class="dashboard-container pb-5">
        <div class="container">
            <!-- HEADER -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
                <h2 class="fw-bold m-0" style="letter-spacing: 2px; text-transform: uppercase;">Dashboard Prenotazioni</h2>
                
                <form action="{{ route('dashboard.toggle') }}" method="POST">
                    @csrf
                    @if($reservationsBlocked)
                        <button type="submit" class="btn btn-outline-contrast rounded-0 px-4 py-2">
                            <i data-lucide="unlock" class="me-2"></i> SBLOCCA PRENOTAZIONI
                        </button>
                    @else
                        <button type="submit" class="btn btn-contrast rounded-0 px-4 py-2 text-danger">
                            <i data-lucide="lock" class="me-2"></i> BLOCCA PRENOTAZIONI
                        </button>
                    @endif
                </form>
            </div>

            <!-- MESSAGGI -->
            @if(session('success'))
                <div class="alert bg-success text-white border-0 rounded-0 mb-4 fw-bold" role="alert">
                    <i data-lucide="check-circle" class="me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($reservationsBlocked)
                <div class="alert bg-warning text-dark border-0 rounded-0 mb-4 fw-bold shadow-lg">
                    <i data-lucide="alert-triangle" class="me-2"></i> LE PRENOTAZIONI SONO ATTUALMENTE BLOCCATE.
                </div>
            @else
                <div class="alert bg-success text-white border-0 rounded-0 mb-4 fw-bold shadow-lg">
                    <i data-lucide="check-circle" class="me-2"></i> LE PRENOTAZIONI SONO ATTUALMENTE ATTIVE.
                </div>
            @endif

            <!-- CALENDARIO / NAVIGATORE DATE -->
            <div class="bg-dark p-4 mb-5 d-flex flex-column flex-md-row justify-content-center align-items-center rounded-3 shadow-lg" style="border: 1px solid #333;">
                <form action="{{ route('dashboard') }}" method="GET" class="date-navigator w-100 justify-content-center">
                    @php
                        $currentDate = \Carbon\Carbon::parse($date);
                        $prevDate = $currentDate->copy()->subDay()->toDateString();
                        $nextDate = $currentDate->copy()->addDay()->toDateString();
                    @endphp
                    
                    <a href="{{ route('dashboard', ['date' => $prevDate]) }}" class="btn btn-outline-contrast rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i data-lucide="chevron-left"></i>
                    </a>
                    
                    <div class="fw-bold mx-2 mx-md-4">
                        <input type="date" name="date" class="date-input fw-bold shadow-sm" value="{{ $date }}" onchange="this.form.submit()">
                    </div>
                    
                    <a href="{{ route('dashboard', ['date' => $nextDate]) }}" class="btn btn-outline-contrast rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i data-lucide="chevron-right"></i>
                    </a>
                    
                    <a href="{{ route('dashboard') }}" class="btn btn-link text-white ms-md-4 text-decoration-none border-start border-secondary ps-4 fw-bold">OGGI</a>
                </form>
            </div>

            <!-- TABELLE PRANZO / CENA -->
            <div class="row g-5">
                
                <!-- PRANZO -->
                <div class="col-12 col-xl-6">
                    <h3 class="section-title text-white">Pranzo <span class="badge bg-light text-dark ms-2 rounded-pill">{{ $pranzo->count() }}</span></h3>
                    <div class="table-responsive rounded-3 overflow-hidden" style="border: 1px solid #333;">
                        <table class="table table-dark-custom mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 80px;" class="py-3 px-4">Ora</th>
                                    <th class="py-3">Cliente / Telefono</th>
                                    <th class="text-center py-3" style="width: 100px;">Ospiti</th>
                                    <th class="py-3 pe-4">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pranzo as $res)
                                    <tr>
                                        <td class="fw-bold fs-5 px-4 text-warning">{{ \Carbon\Carbon::parse($res->time)->format('H:i') }}</td>
                                        <td>
                                            <div class="fw-bold text-dark fs-5">{{ $res->name }}</div>
                                            <a href="tel:{{ $res->phone }}" class="text-muted text-decoration-none small"><i data-lucide="phone" style="width: 12px; height: 12px;" class="me-1"></i>{{ $res->phone }}</a>
                                        </td>
                                        <td class="text-center">
                                            <span class="status-badge">{{ $res->guests }}</span>
                                        </td>
                                        <td class="text-white-50 small pe-4">{{ $res->message ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-white-50">
                                            <i data-lucide="sun" style="width: 40px; height: 40px;" class="mb-3 opacity-25"></i>
                                            <p class="mb-0">Nessuna prenotazione per il pranzo in questa data.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- CENA -->
                <div class="col-12 col-xl-6">
                    <h3 class="section-title text-white">Cena <span class="badge bg-light text-dark ms-2 rounded-pill">{{ $cena->count() }}</span></h3>
                    <div class="table-responsive rounded-3 overflow-hidden" style="border: 1px solid #333;">
                        <table class="table table-dark-custom mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 80px;" class="py-3 px-4">Ora</th>
                                    <th class="py-3">Cliente / Telefono</th>
                                    <th class="text-center py-3" style="width: 100px;">Ospiti</th>
                                    <th class="py-3 pe-4">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cena as $res)
                                    <tr>
                                        <td class="fw-bold fs-5 px-4 text-info">{{ \Carbon\Carbon::parse($res->time)->format('H:i') }}</td>
                                        <td>
                                            <div class="fw-bold text-dark fs-5">{{ $res->name }}</div>
                                            <a href="tel:{{ $res->phone }}" class="text-muted text-decoration-none small"><i data-lucide="phone" style="width: 12px; height: 12px;" class="me-1"></i>{{ $res->phone }}</a>
                                        </td>
                                        <td class="text-center">
                                            <span class="status-badge">{{ $res->guests }}</span>
                                        </td>
                                        <td class="text-white-50 small pe-4">{{ $res->message ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-white-50">
                                            <i data-lucide="moon" style="width: 40px; height: 40px;" class="mb-3 opacity-25"></i>
                                            <p class="mb-0">Nessuna prenotazione per la cena in questa data.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
