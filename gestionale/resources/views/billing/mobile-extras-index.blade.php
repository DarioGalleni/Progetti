@extends('components.layout', ['manifest' => 'manifest-extras.json', 'hideNavbar' => true])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-door-open me-2"></i>Camere Oggi</h4>
                    <p class="mb-0 small text-white-50">{{ now()->format('d/m/Y') }}</p>
                </div>
                <div class="card-body p-3">
                    @if($customers->isEmpty())
                        <div class="alert alert-info text-center">
                            Nessuna camera occupata oggi.
                        </div>
                    @else
                        <div class="d-grid gap-3">
                            @foreach($customers as $customer)
                                <a href="{{ route('mobile.extras.show', $customer) }}"
                                    class="btn btn-outline-primary p-3 text-start d-flex justify-content-between align-items-center shadow-sm">
                                    <div>
                                        <span class="h3 fw-bold mb-0 d-block">{{ $customer->room_number }}</span>
                                        <span class="small text-muted text-uppercase">{{ $customer->last_name }}
                                            {{ $customer->first_name }}</span>
                                    </div>
                                    <i class="bi bi-chevron-right fs-4"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection