<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>
                    Inserisic i tuoi dati
                </h1>
            </div>
        </div>
    </div>

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{route('create_ok')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nome</label>
                        <input name="name" type="text" class="form-control"  aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Cognome</label>
                        <input name="surname" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Luogo di Nascita</label>
                        <input name="placebirth" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
    
            </div>
        </div>
    </div>
    </x-layout>