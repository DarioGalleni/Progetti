<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center my-4">Destinazioni</h1>
            </div>
        </div>
    </div>

<div class="container success">
    <div class="row">
        <div class="col-12 text-center">
            @if (session('success')) 
                <div class="alert alert-success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-12">
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
    </div>

</x-layout>