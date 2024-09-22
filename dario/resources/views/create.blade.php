<x-layout>
    @section('title', 'Inserisci i Tuoi Dati')

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-3">
                <h1>
                    Inserisici tuoi dati
                </h1>
            </div>
        </div>
    </div>

    @if (session('message'))
    <div class="alert alert-success container">
        {{ session('message') }}
    </div>
@endif

    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{route('create_ok')}}" id="guestForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nome</label>
                        <input name="name" type="text" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Cognome</label>
                        <input name="surname" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Luogo di Nascita</label>
                        <select name="placebirth" id="placebirth" class="form-control">
                            <option value="">Seleziona un comune</option>
                        </select>
                        <small id="error-msg" style="color: red; display: none;">Seleziona un comune valido.</small>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Genere</label>
                        <select name="genre_id" required>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Data di Nascita</label>
                        <input name="birthdate" type="date" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Immagine</label>
                        <input name="img" type="file" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
    
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Effettua la chiamata all'API quando la pagina è caricata
            fetch('https://axqvoqvbfjpaamphztgd.functions.supabase.co/comuni')
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById('placebirth');
                    // Aggiunge le opzioni al dropdown
                    data.forEach(comune => {
                        const option = document.createElement('option');
                        option.value = comune.nome;  // Assumi che il campo "nome" contenga il nome del comune
                        option.textContent = comune.nome;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Errore nel recupero dei comuni:', error));
            
            // Aggiungi un event listener al form per la validazione
            document.getElementById('guestForm').addEventListener('submit', function(event) {
                const select = document.getElementById('placebirth');
                const errorMsg = document.getElementById('error-msg');
                
                // Se l'utente non ha selezionato un comune valido (option vuota), mostra l'errore
                if (select.value === "") {
                    event.preventDefault();  // Blocca l'invio del form
                    errorMsg.style.display = "block";  // Mostra il messaggio di errore
                } else {
                    errorMsg.style.display = "none";  // Nasconde il messaggio di errore
                }
            });
        });
        </script>
    </x-layout>