<x-layout>

  <div class="container">
      <div class="row">
          <div class="col-12">
              <table class="table table-striped">
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
              </table>
          </div>
      </div>
  </div>
  </x-layout>