<x-layout>
    @section('title', 'Crea un Nuovo Utente')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mt-5">Crea un Nuovo Utente</h1>
                @if (session('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('usersStore') }}" method="post" enctype="multipart/form-data"> @csrf {{-- Aggiunto enctype per l'upload di file --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Conferma Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Immagine Profilo</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                    </div>
                        <button type="submit" class="btn btn-primary create_button">Crea Utente</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>