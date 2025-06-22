<x-layout>
    @section('title', 'Homepage')

    <div class="container my-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Login</h1>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="container w-50 alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3 text-center">
                        <label for="username" class="form-label">Nome Utente</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 text-center mt-5">
                        <button type="submit" class="btn btn-primary w-50">Accedi</button>
                    </div>

                    @if ($errors->any() && !$errors->has('username') && !$errors->has('password'))
                        <div class="alert alert-danger text-center mt-3" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </form>

                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>Oppure <a href="{{ route('register') }}">Registrati</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>