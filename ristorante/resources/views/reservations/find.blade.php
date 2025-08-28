<x-layout>
    <div class="container-fluid py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="card-title fw-bold">Trova la tua Prenotazione</h2>
                            <p class="text-muted">Inserisci l'email o il numero di telefono che hai usato per prenotare.</p>
                        </div>
                        
                        <form action="{{ route('reservations.search') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="contact" class="form-label">Email o Numero di Telefono</label>
                                <input type="text" class="form-control form-control-custom" id="contact" name="contact" value="{{ old('contact') }}" required>
                            </div>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary-custom">Cerca Prenotazione</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>