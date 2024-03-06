<x-layout>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1>Ecco i nostri prodotti <span class="text-danger">{{$marca}}</span></h1>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
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
                                @foreach($snowboards as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{$item['Tipo']}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($snowboards as $item)
            <x-cards
            tipo="{{ $item['Tipo'] }}"
            descrizione="{{ $item['descrizione'] }}"
            price="{{ $item['price'] }}"
            url="{{ $item['url'] }}"
            link="{{ route('mostra', ['id' => $item['id']]) }}"
            />
            @endforeach
        </div>
    </div>
    
    
</x-layout>