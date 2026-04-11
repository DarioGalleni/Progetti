<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <x-navbar />
    {{ $slot }}

    <!-- Search Reservation Modal -->
    <div class="modal fade" id="searchReservationModal" tabindex="-1" aria-labelledby="searchReservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 justify-content-between align-items-center px-4 pt-4">
                    <h5 class="modal-title fw-bold" id="searchReservationModalLabel">Cerca la tua Prenotazione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-4 px-4">
                    <form action="{{ route('reservations.search') }}" method="GET">
                        <div class="mb-3">
                            <label for="searchPhone" class="form-label text-muted">Numero di Telefono <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control bg-light border-0 py-2 @error('phone') is-invalid @enderror"
                                id="searchPhone" name="phone" placeholder="Es. 3331234567" required
                                value="{{ old('phone', request('phone')) }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="searchName" class="form-label text-muted">Nome Associato <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control bg-light border-0 py-2 @error('name') is-invalid @enderror"
                                id="searchName" name="name" placeholder="Es. Mario Rossi" required
                                value="{{ old('name', request('name')) }}">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit"
                            class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i data-lucide="search" style="width: 18px; height: 18px;"></i> Cerca
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($errors->has('phone') || $errors->has('name'))
        <script type="module">
            setTimeout(() => {
                if (window.bootstrap) {
                    var searchModal = new window.bootstrap.Modal(document.getElementById('searchReservationModal'));
                    searchModal.show();
                }
            }, 100);
        </script>
    @endif
</body>

</html>