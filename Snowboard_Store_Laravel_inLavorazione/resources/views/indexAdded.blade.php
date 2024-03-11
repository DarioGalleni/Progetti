<x-layout>

<div class="container mt-5">
    <div class="row">
        {{-- accordion --}}
        <div class="col-12 col-md-6">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Accordion Item #1
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{-- radio buttons --}}
                        @foreach ($snowboard as $item)
                        <button class="btn btn-primary d-block my-3">{{$item->name}}</button>
                        @endforeach
                        {{-- radio buttons --}}
                    </div>
                  </div>
                </div>
            </div>
        </div>
        {{-- fine accordion --}}
        {{-- cards --}}
        <div class="col-12 col-md-3">
            @foreach ($snowboard as $item)
            <div class="card shadow d-none" style="width: 18rem;">
                <img src="\img\default.jpg" alt="" class="p-1">
                <div class="card-body">
                  <h5 class="card-title">{{$item->name}}</h5>
                  <p class="card-text"></p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            @endforeach

        </div>
        {{-- fine cards --}}
    </div>
</div>

</x-layout>
