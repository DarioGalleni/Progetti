<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-lg">
    <div class="container-fluid d-md-flex justify-content-between">
        <div class="d-flex justify-content-between w-100">
            <a class="navbar-brand" href="#">Navbar</a>
            <div class="d-none d-md-flex align-items-center">
                @auth
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endauth
            </div>
        </div>
        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('create')}}">Crea</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}">Tutti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('search')}}">Cerca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>

