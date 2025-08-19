<x-layout>
    @section('title', 'Modifica Utente: ' . $user->name)

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mt-5">Modifica Utente: {{ $user->username }}</h1>
                @if (session('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('usersUpdate', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname', $user->surname) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nuova Password (lascia vuoto per non cambiare)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Conferma Nuova Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Immagine Profilo</label>
                        @if ($user->profile_image && $user->profile_image !== 'profile_images/default.jpg')
                            <div class="mb-2">
                                <p>Immagine attuale:</p>
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Immagine Profilo Attuale" class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                            </div>
                        @else
                            <div class="mb-2">
                                <p>Nessuna immagine personalizzata (usa default).</p>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                        <div class="form-check mt-2">
                            {{-- <input class="form-check-input" type="checkbox" id="remove_profile_image" name="remove_profile_image" value="1"> --}}
                            {{-- <label class="form-check-label" for="remove_profile_image">
                                Rimuovi immagine corrente e usa quella di default
                            </label> --}}
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_admin">È Amministratore?</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Aggiorna Utente</button>
                    <a href="{{ route('usersShow', $user) }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</x-layout>