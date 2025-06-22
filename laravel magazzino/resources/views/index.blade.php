<x-layout>
    @section('title', 'Tutti gli utenti')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h4>Benvenuto, {{ Auth::user()->name }}!</h4>
                <p>Sei loggato correttamente.</p>
                    
                </div>
            </div>
        </div>
</x-layout>            



