<x-layout>
    @section('title', 'Dettagli Utente: ' . $user->name)

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mt-5">Dettagli Utente</h1>
                <p class="lead">Ecco i dettagli completi per {{ $user->name }} {{ $user->surname }}.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-4">
                <div class="card mt-4">
                    <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $user->profile_image) }}" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Immagine Profilo">
                        {{-- <img src="{{ asset($user->profile_image) }}" class="card-img-top img-fluid border p-1 rounded" alt="Immagine Utente"> --}}
                        <h4 class="card-title">{{ $user->name }} {{ $user->surname }}</h4>
                        <p class="card-text"><strong>Username:</strong> {{ $user->username }}</p>
                        <p class="card-text"><strong>ID Utente:</strong> {{ $user->id }}</p>
                        <p class="card-text"><strong>Registrato il:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                        <hr>
                        <a href="{{ route('allUsers') }}" class="btn btn-secondary">Torna alla lista Utenti</a>

                        @can('access-admin-features')
                            <form action="{{ route('usersDestroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo utente? Questa operazione è irreversibile.')">Elimina Utente</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>