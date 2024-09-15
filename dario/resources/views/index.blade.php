<x-layout>
    <div class="container">
        <div class="row">
            @foreach ($guests as $item)
            <div class="col-5">
                <div class="card" style="">
                    <img src="https://picsum.photos/100/100" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{$item->name}}</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="{{route('show', $item->id) }}" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
                </div>
                @endforeach
        </div>
    </div>
</x-layout>