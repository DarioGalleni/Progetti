<nav class="navbar sticky-top navbar-expand-lg shadow">
  <div class="container-fluid">
    <a href="{{route('home')}}" class="text-white"><span class="material-symbols-outlined fs-1">home</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-md-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('index')}}">Sempre Disponibili</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('crea')}}">Aggiungi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('indexAdded')}}">Aggiunti</a>
        </li>
      </ul>
    </div>
  </div>
  </nav>
