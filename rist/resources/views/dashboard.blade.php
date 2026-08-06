<x-layout>
    <style>
        body {
            background-color: #000 !important;
            color: #fff !important;
        }
        
        .dashboard-container {
            background-color: #000;
            min-height: 100vh;
            padding-top: 150px;
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

        .table-dark-custom td, .table-dark-custom tr {
            background-color: #111 !important;
            color: #fff !important;
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
            background-color: #fff !important;
            color: #000 !important;
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
        
        .border-dashed {
            border-style: dashed !important;
        }

        @media (max-width: 767.98px) {
            .dashboard-container {
                padding-top: 120px;
            }
            .section-title {
                font-size: 1.2rem;
            }
        }
    </style>

    <div class="dashboard-container pb-5">
        <div class="container">
            <!-- HEADER -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 mb-md-5 gap-3 text-center text-md-start">
                <h2 class="fw-bold m-0" style="letter-spacing: 2px; text-transform: uppercase;">Dashboard <span class="d-none d-md-inline">Prenotazioni</span></h2>
                
                <form action="{{ route('dashboard.toggle') }}" method="POST" class="w-100 w-md-auto">
                    @csrf
                    @if($reservationsBlocked)
                        <button type="submit" class="btn btn-outline-contrast rounded-0 px-4 py-2 w-100 w-md-auto">
                            <i data-lucide="unlock" class="me-2"></i> SBLOCCA PRENOTAZIONI
                        </button>
                    @else
                        <button type="submit" class="btn btn-contrast rounded-0 px-4 py-2 text-danger w-100 w-md-auto">
                            <i data-lucide="lock" class="me-2"></i> BLOCCA PRENOTAZIONI
                        </button>
                    @endif
                </form>
            </div>

            <!-- MESSAGGI -->
            @if(session('success'))
                <div class="alert bg-success text-white border-0 rounded-0 mb-4 fw-bold" role="alert">
                    <i data-lucide="check-circle" class="me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white float-end" data-bs-dismiss="alert" aria-label="Chiudi"></button>
                </div>
            @endif

            @if($reservationsBlocked)
                <div class="alert bg-warning text-dark border-0 rounded-0 mb-4 fw-bold shadow-lg d-flex align-items-center">
                    <i data-lucide="alert-triangle" class="me-2 flex-shrink-0"></i> 
                    <span class="small md-fs-6">LE PRENOTAZIONI SONO ATTUALMENTE BLOCCATE.</span>
                </div>
            @else
                <div class="alert bg-success text-white border-0 rounded-0 mb-4 fw-bold shadow-lg d-flex align-items-center">
                    <i data-lucide="check-circle" class="me-2 flex-shrink-0"></i> 
                    <span class="small md-fs-6">LE PRENOTAZIONI SONO ATTUALMENTE ATTIVE.</span>
                </div>
            @endif

            <!-- CALENDARIO / NAVIGATORE DATE -->
            <div class="bg-dark p-3 p-md-4 mb-4 mb-md-5 rounded-3 shadow-lg" style="border: 1px solid #333;">
                <form action="{{ route('dashboard') }}" method="GET" class="d-flex flex-wrap flex-md-nowrap align-items-center justify-content-center gap-2 gap-md-3">
                    @php
                        $currentDate = \Carbon\Carbon::parse($date);
                        $prevDate = $currentDate->copy()->subDay()->toDateString();
                        $nextDate = $currentDate->copy()->addDay()->toDateString();
                    @endphp
                    
                    <a href="{{ route('dashboard', ['date' => $prevDate]) }}" class="btn btn-outline-contrast rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                        <i data-lucide="chevron-left"></i>
                    </a>
                    
                    <div class="fw-bold flex-grow-1 flex-md-grow-0 text-center">
                        <input type="date" name="date" class="date-input w-100 fw-bold shadow-sm" style="max-width: 250px;" value="{{ $date }}" onchange="this.form.submit()">
                    </div>
                    
                    <a href="{{ route('dashboard', ['date' => $nextDate]) }}" class="btn btn-outline-contrast rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                        <i data-lucide="chevron-right"></i>
                    </a>
                    
                    <a href="{{ route('dashboard') }}" class="btn btn-link text-white text-decoration-none border-secondary ps-md-3 border-start-md fw-bold w-100 w-md-auto mt-2 mt-md-0 text-center d-md-block d-none">OGGI</a>
                </form>
                <div class="text-center mt-3 d-block d-md-none border-top border-secondary pt-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-link text-white text-decoration-none fw-bold small"><i data-lucide="calendar" class="me-2 d-inline" style="width: 14px;"></i> TORNA A OGGI</a>
                </div>
            </div>

            <!-- TABELLE PRANZO / CENA -->
            <div class="row g-4 g-md-5">
                
                <!-- PRANZO -->
                <div class="col-12 col-xl-6">
                    <h3 class="section-title text-white">Pranzo <span class="badge bg-light text-dark ms-2 rounded-pill">{{ $pranzo->count() }}</span></h3>
                    
                    <!-- Desktop Table View -->
                    <div class="table-responsive rounded-3 overflow-hidden d-none d-md-block" style="border: 1px solid #333;">
                        <table class="table table-dark table-dark-custom mb-0">
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
                                            <div class="fw-bold text-white fs-5">{{ $res->name }}</div>
                                            <a href="tel:{{ $res->phone }}" class="text-muted text-decoration-none small"><i data-lucide="phone" style="width: 12px; height: 12px;" class="me-1"></i>{{ $res->phone }}</a>
                                        </td>
                                        <td class="text-center">
                                            <span class="status-badge">{{ $res->people }}</span>
                                        </td>
                                        <td class="text-white-50 small pe-4">{{ $res->notes ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-white-50 border-0">
                                            <i data-lucide="sun" style="width: 40px; height: 40px;" class="mb-3 opacity-25"></i>
                                            <p class="mb-0">Nessuna prenotazione per il pranzo in questa data.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards View -->
                    <div class="d-block d-md-none">
                        @forelse($pranzo as $res)
                            <div class="card bg-dark border-secondary mb-3 shadow-sm rounded-3">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="fw-bold text-warning fs-3">{{ \Carbon\Carbon::parse($res->time)->format('H:i') }}</div>
                                        <span class="status-badge"><i data-lucide="users" style="width: 14px; height: 14px;" class="me-1 d-inline"></i>{{ $res->people }}</span>
                                    </div>
                                    <div class="fw-bold text-white fs-5 mb-1">{{ $res->name }}</div>
                                    <a href="tel:{{ $res->phone }}" class="d-inline-flex align-items-center text-muted text-decoration-none mb-2 mt-1">
                                        <div class="bg-secondary bg-opacity-25 rounded-circle p-1 me-2 d-flex align-items-center justify-content-center">
                                            <i data-lucide="phone" style="width: 14px; height: 14px;"></i>
                                        </div>
                                        {{ $res->phone }}
                                    </a>
                                    @if($res->notes)
                                        <div class="mt-2 pt-2 border-top border-secondary text-white-50 small">
                                            <i data-lucide="file-text" style="width: 12px; height: 12px;" class="me-1 d-inline"></i> {{ $res->notes }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-white-50 border border-secondary rounded-3 border-dashed">
                                <i data-lucide="sun" style="width: 30px; height: 30px;" class="mb-2 opacity-25"></i>
                                <p class="mb-0 small">Nessuna prenotazione per il pranzo.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- CENA -->
                <div class="col-12 col-xl-6">
                    <h3 class="section-title text-white">Cena <span class="badge bg-light text-dark ms-2 rounded-pill">{{ $cena->count() }}</span></h3>
                    
                    <!-- Desktop Table View -->
                    <div class="table-responsive rounded-3 overflow-hidden d-none d-md-block" style="border: 1px solid #333;">
                        <table class="table table-dark table-dark-custom mb-0">
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
                                            <div class="fw-bold text-white fs-5">{{ $res->name }}</div>
                                            <a href="tel:{{ $res->phone }}" class="text-muted text-decoration-none small"><i data-lucide="phone" style="width: 12px; height: 12px;" class="me-1"></i>{{ $res->phone }}</a>
                                        </td>
                                        <td class="text-center">
                                            <span class="status-badge">{{ $res->people }}</span>
                                        </td>
                                        <td class="text-white-50 small pe-4">{{ $res->notes ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-white-50 border-0">
                                            <i data-lucide="moon" style="width: 40px; height: 40px;" class="mb-3 opacity-25"></i>
                                            <p class="mb-0">Nessuna prenotazione per la cena in questa data.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards View -->
                    <div class="d-block d-md-none">
                        @forelse($cena as $res)
                            <div class="card bg-dark border-secondary mb-3 shadow-sm rounded-3">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="fw-bold text-info fs-3">{{ \Carbon\Carbon::parse($res->time)->format('H:i') }}</div>
                                        <span class="status-badge"><i data-lucide="users" style="width: 14px; height: 14px;" class="me-1 d-inline"></i>{{ $res->people }}</span>
                                    </div>
                                    <div class="fw-bold text-white fs-5 mb-1">{{ $res->name }}</div>
                                    <a href="tel:{{ $res->phone }}" class="d-inline-flex align-items-center text-muted text-decoration-none mb-2 mt-1">
                                        <div class="bg-secondary bg-opacity-25 rounded-circle p-1 me-2 d-flex align-items-center justify-content-center">
                                            <i data-lucide="phone" style="width: 14px; height: 14px;"></i>
                                        </div>
                                        {{ $res->phone }}
                                    </a>
                                    @if($res->notes)
                                        <div class="mt-2 pt-2 border-top border-secondary text-white-50 small">
                                            <i data-lucide="file-text" style="width: 12px; height: 12px;" class="me-1 d-inline"></i> {{ $res->notes }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-white-50 border border-secondary rounded-3 border-dashed">
                                <i data-lucide="moon" style="width: 30px; height: 30px;" class="mb-2 opacity-25"></i>
                                <p class="mb-0 small">Nessuna prenotazione per la cena.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
