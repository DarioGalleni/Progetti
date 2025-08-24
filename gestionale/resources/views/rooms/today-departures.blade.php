<x-layout>
    <div class="container-fluid mt-5">
<h1 class="mb-4 text-center">Stato Camere di oggi, {{ \Carbon\Carbon::parse($today)->locale('it')->isoFormat('D MMMM') }}</h1>

        @if(empty($allRooms))
            <div class="alert alert-info" role="alert">
                Nessuna camera in arrivo, in partenza o in fermo per oggi.
            </div>
        @else
            <table class="table table-bordered text-center">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Numero Camera</th>
                        <th scope="col">In Arrivo</th>
                        <th scope="col">In Partenza</th>
                        <th scope="col">In Fermo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allRooms as $room)
                        <tr>
                            <td>{{ $room }}</td>
                            <td>
                                @if(in_array($room, $arrivingRooms))
                                    <span class="text-primary fs-4 fw-bold">&#10003;</span>
                                @endif
                            </td>
                            <td>
                                @if(in_array($room, $departingRooms))
                                    <span class="text-danger fs-4 fw-bold">&#10003;</span>
                                @endif
                            </td>
                            <td>
                                @if(in_array($room, $stayingRooms))
                                    <span class="text-success fs-4 fw-bold">&#10003;</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        <div class="mt-4 d-flex justify-content-center">
            <a href="{{ route('welcome') }}" class="btn btn-primary">Torna al Calendario</a>
        </div>
    </div>
</x-layout>