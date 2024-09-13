<form method="POST" action="{{route('aggiungi')}}">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Marca</label>
        <input name="brand" type="text" class="form-control"  aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Prezzo</label>
        <input name="price" type="number" step="0.01" class="form-control" id="price">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nome</label>
        <input name="name" type="text" class="form-control" id="exampleInputPassword1">
    </div>

        <button type="submit" class="btn btn-primary">Submit</button>
</form>
