<x-layout>
    <div class="container my-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1>Dettagli del Viaggio: {{ $destination->destination }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 mb-4">
                @if (count($images) > 0)
                    <div class="swiper mySwiper swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset($image) }}" alt="Immagine di {{ $destination->destination }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        Nessuna immagine trovata per questa destinazione. Assicurati che le immagini siano nella cartella configurata.
                    </div>
                @endif
            </div>

            <div class="col-lg-5">
                <h3>Informazioni sul Viaggio</h3>
                <hr>
                <p>
                    <strong>Durata:</strong> {{ $destination->duration }} giorni
                </p>
                <p>
                    <strong>Prezzo a persona:</strong> <span class="h4 text-success">€{{ $destination->price }}</span>
                </p>
                <p class="mt-4">
                    {{ $destination->details }}
                </p>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto",
                loop: true,
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        </script>
    @endpush
</x-layout>