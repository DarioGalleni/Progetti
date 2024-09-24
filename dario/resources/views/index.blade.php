<x-layout>
    @section('title', 'Tutti gli utenti')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Tutti gli utenti</h1>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-between">
            @foreach($guests as $item)
            <div class="col-12 col-md-3">
                <div class="card" style="width: 18rem;">
                  @if(file_exists(public_path('img/' . $item->img)))
      <img src="{{ asset('img/' . $item->img) }}" alt="Immagine utente">
  @else
      <img src="{{ asset('img/default.jpg') }}" alt="Immagine predefinita">
  @endif
  
                  <div class="card-body">
                    <p class="card-text">{{$item->name}}</p>
                  </div>
                </div>
              </div>
                @endforeach
        </div>
    </div>
    </x-layout>


  {{-- <div class="container mt-5">
      <div class="row justify-content-between">
          @foreach($guests as $item)
          <div class="col-12 col-md-3">
              <div class="card" style="width: 18rem;">
                <img class="img-fluid" src="{{Storage::url($item->img)}}" alt="">
                <div class="card-body">
                  <p class="card-text">{{$item->name}}</p>
                </div>
              </div>
            </div>
              @endforeach
      </div>
  </div>
  </x-layout> --}}

  {{-- <table class="table table-striped">
                  <tr>
                      <th>Nome</th>
                      <th>Cognome</th>
                      <th>Luogo di Nascita</th>
                      <th>Data di Nascita</th>
                      <th>Genere</th>
                  </tr>
                  @foreach ($guests as $item)
                  <tr>
                      <td>{{$item->name}}</td>
                      <td>{{$item->surname}}</td>
                      <td>{{$item->placebirth}}</td>
                      <td>{{$item->birthdate}}</td>
                      <td>{{$item->genre->genre}}</td> </tr>
                  @endforeach
              </table> --}}