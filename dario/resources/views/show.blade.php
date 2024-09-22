<x-layout>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Dettagli di {{$guests->name}}</h1>

                <img class="img-fluid" src="{{Storage::url($guests->img)}}" alt="">
            </div>
        </div>
    </div>
</x-layout>