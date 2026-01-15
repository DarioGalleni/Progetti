<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card beach-card">
                    <div class="card-header text-center">
                        <h3 class="text-sea"><i class="fas fa-user-plus me-2"></i>Registrati</h3>
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
                                <i class="fas fa-info-circle fs-4 text-info me-3 mt-1"></i>
                                <div>
                                    <h6 class="fw-bold text-info mb-1">Accesso Immediato</h6>
                                    <p class="mb-2 small text-muted">
                                        La registrazione è richiesta per gli utenti reali. Se desideri solo testare le
                                        funzionalità,
                                        puoi saltare la registrazione.
                                    </p>
                                    <a href="{{ route('login.guest') }}"
                                        class="btn btn-sm btn-outline-info rounded-pill px-3">
                                        <i class="fas fa-arrow-right me-1"></i> Vai alla Demo (Ospite)
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" required autofocus disabled>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" required disabled>
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

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Conferma Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required disabled>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" disabled>
                                    <i class="fas fa-user-plus me-2"></i>Registrati
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <span>Hai già un account?</span>
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    Accedi (Non disp.)
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>