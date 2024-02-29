<div class="card rounded text-center" style="width: 18rem;">
    <img src="{{$url}}" class="mt-2 rounded" alt="...">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{$tipo}}</h5>
        <p class="card-text">{{$descrizione}}</p>
        <p class="card-text">Euro: {{$price}}</p>
        <div class="mt-auto">
            <a href="{{$link}}" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>