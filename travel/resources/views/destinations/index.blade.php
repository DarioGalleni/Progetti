<x-layout>

        <div class="py-5" id="destinations">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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