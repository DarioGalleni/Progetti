<x-layout>

        <div class="py-5" id="destinations">
        <div class="container">
            <h2 class="text-center section-title">Tutte le nostre destinazioni</h2>
            <div class="row">
                @foreach ($destinations as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            {{-- cards --}}
                            <x-cards :item="$item" />
                            {{-- fine cards --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-layout>