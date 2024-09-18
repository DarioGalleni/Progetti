<x-layout>
    <div class="container">
        <h1>Ricerca Ospiti</h1>
        
        <form action="{{ route('search') }}" method="GET">
            <div class="mb-3">
                <input type="text" name="query" class="form-control" placeholder="Inserisci un nome">
            </div>
            <button type="submit" class="btn btn-primary">Cerca</button>
        </form>
    
            <div class="row mt-5">
                @foreach ($guests as $item)
                <div class="col-5">
                    <div class="card">
                        <img src="https://picsum.photos/100/100" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $item->name }}</h5>
                          <p class="card-text">Altre informazioni sull'ospite</p>
                          <a href="{{ route('show', $item->id) }}" class="btn btn-primary">Vai al profilo</a>
                        </div>
                      </div>
                    </div>
                @endforeach
            </div>
    </div>
    <script>
        // Svuota il campo input dopo il caricamento della pagina
        window.onload = function() {
            document.querySelector('input[name="query"]').value = '';
        }
    </script>
    
</x-layout>