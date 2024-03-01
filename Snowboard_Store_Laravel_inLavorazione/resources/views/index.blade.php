<x-layout>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1>Ecco i nostri prodotti <span class="text-danger">{{$marca}}</span></h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center gap-2">
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