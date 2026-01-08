<nav class="navbar navbar-expand-lg navbar-dark {{ Request::routeIs('home') ? 'bg-transparent' : 'bg-dark' }} fixed-top transition-all duration-300"
    id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-uppercase" href="{{ route('home') }}">
            Start<span class="text-primary">Journey</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fs-5 mx-2 {{ Request::routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 mx-2 {{ Request::routeIs('journeys.index') ? 'active' : '' }}"
                        href="{{ route('journeys.index') }}">Viaggi</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary rounded-pill px-4 ms-2 {{ Request::routeIs('journeys.create') ? 'active' : '' }}"
                        href="{{ route('journeys.create') }}"><i class="bi bi-plus-lg"></i> Nuovo</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Custom Navbar Styling */
    .navbar {
        transition: background-color 0.3s ease, padding 0.3s ease;
        padding: 1.5rem 0;
    }

    .navbar.scrolled {
        background-color: rgba(0, 0, 0, 0.9) !important;
        backdrop-filter: blur(10px);
        padding: 0.8rem 0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        position: relative;
        font-weight: 500;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #0d6efd;
        transition: width 0.3s ease;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }
</style>

<script>
    window.addEventListener('scroll', function () {
        if (window.scrollY > 50) {
            document.getElementById('mainNav').classList.add('scrolled');
        } else {
            document.getElementById('mainNav').classList.remove('scrolled');
        }
    });
</script>