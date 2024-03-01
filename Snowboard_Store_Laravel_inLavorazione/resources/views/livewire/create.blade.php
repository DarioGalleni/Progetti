<div>
    @if (session('status'))
    <div class="alert alert-success text-center">
        {{ session('status') }}
    </div>
@endif
        <div class="row justify-content-center">
            <div class="col-12">
                <form wire:submit="store">
                    <div class="mb-3">
                        <label for="exampleName" class="form-label">Nome</label>
                        <input wire:model="name" type="text" class="form-control" id="exampleName" aria-describedby="nameHelp">
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="examplePrice" class="form-label">Prezzo</label>
                        <input wire:model="price" type="number" class="form-control" id="exampleInputPrice">
                        @error('price') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleDescription" class="form-label">Descrizione</label>
                        <textarea class="form-control" type="text" id="exampleFormControlTextarea1" rows="3" wire:model="description"></textarea>
                        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Invia</button>
                </form>
            </div>
        </div>
    </div>
</div>
