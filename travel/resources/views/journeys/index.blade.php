<x-layout title="Viaggi">

    <div class="container py-5 mt-5">
        <div class="row mb-5 text-center position-relative">
            <div class="col-12">
                <h1 class="display-4 fw-bold animate-fade-in-up">I Nostri Viaggi</h1>
                <p class="lead text-muted animate-fade-in-up delay-1">Scegli la tua prossima avventura tra le nostre
                    proposte esclusive.</p>
            </div>
        </div>

        @if (session('success'))
            <div id="success-alert"
                class="alert alert-success border-0 bg-success-subtle text-success rounded-3 mb-5 d-flex align-items-center animate-bounce justify-content-center">
                <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                <div>
                    <h6 class="fw-bold mb-0">Operazione completata!</h6>
                    <p class="mb-0 small">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <script>
            setTimeout(function() {
                var alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }
            }, 5000);
        </script>

        <div class="row g-4">
            @foreach($journeys as $journey)
                <div class="col-md-6 col-lg-4 animate-fade-in-up delay-2">
                    <div class="card h-100 border-0 shadow-lg overflow-hidden hover-card rounded-4">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img src="{{ $journey->image }}"
                                class="card-img-top w-100 h-100 object-fit-cover transition-transform"
                                alt="{{ $journey->title }}">
                            <div
                                class="position-absolute top-0 end-0 m-3 bg-white px-3 py-1 rounded-pill shadow-sm fw-bold text-primary">
                                {{ $journey->duration_days }} Giorni
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h3 class="h4 card-title fw-bold mb-3">{{ $journey->title }}</h3>
                            <p class="card-text text-muted mb-4">{{ Str::limit($journey->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span
                                    class="fs-4 fw-bold text-primary">€{{ number_format($journey->price, 0, ',', '.') }}</span>
                                <a href="{{ route('journeys.show', $journey) }}"
                                    class="btn btn-outline-primary rounded-pill px-4">Dettagli</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-layout>