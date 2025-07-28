<x-layout>
    @section('title', 'Tutti gli Utenti')

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mt-5">Lista di Tutti gli Utenti</h1>
                <p class="lead">Ecco la lista di tutti gli utenti registrati.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                @if (session('warning'))
                    <div class="alert alert-warning mt-3">
                        {{ session('warning') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($users as $item)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill" style="width: 18rem;">
                        <img src="{{ asset('storage/' . $item->profile_image) }}" class="card-img-top img-fluid border p-1 rounded" alt="Immagine Utente">
                        {{-- <img src="{{ asset($item->profile_image) }}" class="card-img-top img-fluid border p-1 rounded" alt="Immagine Utente"> --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">{{$item->surname}}</p>
                            <p class="card-text">
                            @if($item->is_admin)
                            <span class="badge bg-primary">Admin</span>
                            @endif
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('usersShow', $item->id) }}" class="btn btn-info btn-sm">Vedi Dettagli</a>
                                @auth
                                    @if (Auth::user()->is_admin)
                                        <a href="{{ route('usersEdit', $item->id) }}" class="btn btn-warning btn-sm ms-2">Modifica</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>