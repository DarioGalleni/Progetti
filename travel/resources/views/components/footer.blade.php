<footer class="bg-dark text-white pt-5 pb-4 section-padding">
    <div class="container text-md-left">
        <div class="row text-md-left">
            <!-- Brand and Description -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">StartJourney</h5>
                <p class="text-white-50">La tua porta d'accesso alle avventure più straordinarie del mondo. Esperienze autentiche, ricordi indimenticabili.</p>
            </div>

            <!-- Links -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Esplora</h5>
                <p><a href="{{ route('home') }}" class="text-white-50 text-decoration-none hover-primary">Home</a></p>
                <p><a href="{{ route('journeys.index') }}" class="text-white-50 text-decoration-none hover-primary">I Nostri Viaggi</a></p>
                <p><a href="#" class="text-white-50 text-decoration-none hover-primary">Offerte</a></p>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Contatti</h5>
                <p class="text-white-50"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> Via Roma 123, 00184 Roma, Italia</p>
                <p class="text-white-50"><i class="bi bi-telephone-fill me-2 text-primary"></i> +39 06 123 4567</p>
                <p class="text-white-50"><i class="bi bi-envelope-fill me-2 text-primary"></i> info@startjourney.it</p>
                <p class="text-white-50"><i class="bi bi-clock-fill me-2 text-primary"></i> Lun - Ven: 09:00 - 18:00</p>
            </div>

            <!-- Social -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Seguici</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white fs-4 hover-primary"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-4 hover-primary"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-4 hover-primary"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
        </div>

        <hr class="mb-4 mt-5 border-secondary">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p class="text-white-50">
                    Copyright © {{ date('Y') }} Tutti i diritti riservati da: 
                    <a href="#" class="text-primary text-decoration-none fw-bold">StartJourney Ltd</a>
                </p>
            </div>
            <div class="col-md-5 col-lg-4 text-md-end text-white-50">
                <p>P.IVA IT12345678901</p>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-primary:hover {
        color: #0d6efd !important;
        transition: color 0.3s ease;
    }
</style>