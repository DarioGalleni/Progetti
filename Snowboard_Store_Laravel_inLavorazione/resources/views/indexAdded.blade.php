<x-layout>

<div class="container my-5">
    <div class="row">
        <div class="col-12 p-0">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($snowboard as $item)
                    <tr>
                        <th>{{$item->id}}</th>
                        <td>{{$item->name}}</td>
                        <td>Euro: {{$item->price}}</td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-layout>
