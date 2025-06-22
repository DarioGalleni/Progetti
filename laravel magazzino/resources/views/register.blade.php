<x-layout>
    @section('title', 'Registrazione')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Registrazione</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    @if ($errors->any() && !$errors->has('name') && !$errors->has('username') && !$errors->has('email') && !$errors->has('password'))
                        <div class="alert alert-danger text-center mt-3" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3 text-center">
                        <label for="name" class="form-label">Nome</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <label for="password_confirmation" class="form-label">Conferma Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control">
                    </div>

                    <div class="col-12 text-center mt-5">
                        <button type="submit" class="btn btn-primary w-50">Registrati</button>
                    </div>
                </form>

                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center mt-3">
                            <h2>Hai già un account? <a href="{{ route('login') }}">Accedi</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>