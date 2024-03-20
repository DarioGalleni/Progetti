<x-layout>

<div class="container mt-5">
    <div class="row justify-content-center">
      @forelse ($snowboard as $item)
  

          <div class="card px-0" style="width: 18rem;">
            <img class="p-1" src="https://picsum.photos/200/200" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$item->name}}</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          @empty
          <div class="alert alert-danger">
            no
          </div>
          <div class="card-body">
            
          </div>
      @endforelse
    </div>
</div>

</x-layout>
