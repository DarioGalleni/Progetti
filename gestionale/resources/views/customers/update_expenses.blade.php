<x-layout>
    <div class="container mt-5">
        <h2 class="mb-4">Aggiorna Spese Aggiuntive per {{ $customer->first_name }} {{ $customer->last_name }} (Camera {{ $customer->room }})</h2>
        
        <form action="{{ route('customers.updateExpenses', $customer->id) }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="spiaggia" class="form-label">Spiaggia</label>
                        <input type="number" step="0.01" class="form-control" name="expenses[spiaggia][amount]" value="{{ old('expenses.spiaggia.amount', $existingExpenses['spiaggia']->amount ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bici" class="form-label">Bici</label>
                        <input type="number" step="0.01" class="form-control" name="expenses[bici][amount]" value="{{ old('expenses.bici.amount', $existingExpenses['bici']->amount ?? '') }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pasti" class="form-label">Pasti</label>
                        <input type="number" step="0.01" class="form-control" name="expenses[pasti][amount]" value="{{ old('expenses.pasti.amount', $existingExpenses['pasti']->amount ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bevande" class="form-label">Bevande</label>
                        <input type="number" step="0.01" class="form-control" name="expenses[bevande][amount]" value="{{ old('expenses.bevande.amount', $existingExpenses['bevande']->amount ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="late_checkout" class="form-label">Late Checkout</label>
                        <input type="number" step="0.01" class="form-control" name="expenses[late_checkout][amount]" value="{{ old('expenses.late_checkout.amount', $existingExpenses['late_checkout']->amount ?? '') }}">
                    </div>
                </div>
                                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="late_checkout" class="form-label">Altro</label>
                        <input type="number" step="0.01" class="form-control" name="expenses[altro][amount]" value="{{ old('expenses.altro.amount', $existingExpenses['altro']->amount ?? '') }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-4">Salva Spese</button>
            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-secondary mt-4">Annulla</a>
        </form>
    </div>
</x-layout>