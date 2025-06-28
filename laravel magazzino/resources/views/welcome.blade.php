<x-layout>
@section('title', 'Homepage')
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="mt-5">Welcome to Our Application</h1>
            <p class="lead">This is a simple Laravel application to demonstrate the welcome page.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        </div>
    </div>
</div>
</x-layout>