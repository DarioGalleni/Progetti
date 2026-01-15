<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card beach-card">
                    <div class="card-header text-center">
                        <h3 class="text-sea"><i class="fas fa-umbrella-beach me-2"></i>Accedi</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="alert alert-info border-info-subtle bg-light-info mb-4">
                            <div class="d-flex">
                                <i class="fas fa-shield-alt fs-4 text-info me-3 mt-1"></i>
                                <div class="d-flex flex-column">
                                    <h6 class="fw-bold text-info mb-1">Sicurezza & Accesso Demo</h6>
                                    <p class="mb-2 small text-muted">
                                        Per motivi di sicurezza, l'accesso a questa applicazione è normalmente limitato agli utenti registrati.
                                        Tuttavia, per agevolare il testing, è disponibile un accesso <strong>Ospite</strong> rapido.
                                    </p>
                                    <a href="{{ route('login.guest') }}" class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm">
                                        <i class="fas fa-user-secret me-1 text-center"></i> Entra come Ospite (Demo)
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        id="email" name="email" value="{{ old('email') }}" required disabled>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        id="password" name="password" required disabled>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ricordami</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" disabled>
                                    <i class="fas fa-sign-in-alt me-2"></i>Accedi
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <span>Non hai un account?</span>
                                <a href="{{ route('register') }}" class="text-decoration-none">
                                    Registrati (Non disp.)
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>