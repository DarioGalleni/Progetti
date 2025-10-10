<!doctype html>
<html lang="it">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Dettaglio cliente - {{ $customer->first_name }} {{ $customer->last_name }}</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		/* body { padding: 20px; color: #222; }
		.header { margin-bottom: 20px; }
		.section { margin-bottom: 16px; }
		.kv { display:flex; justify-content:space-between; padding:6px 0; border-bottom:1px dashed #eee; }
		.kv strong { margin-right: 10px; } */
	</style>
</head>
<body>
	<div class="container">
		<header class="header">
			<h1>Dettaglio cliente</h1>
			<p class="text-muted">Clienteee: <strong>{{ $customer->first_name }} {{ $customer->last_name }}</strong> — Camera: <strong>{{ $customer->room }}</strong></p>
		</header>

		<section class="section card">
			<div class="card-body">
				<h5>Informazioni anagraficheeeeee</h5>
				<div class="kv"><span>ID</span><span>{{ $customer->id }}</span></div>
				<div class="kv"><span>Nome</span><span>{{ $customer->first_name }}</span></div>
				<div class="kv"><span>Cognome</span><span>{{ $customer->last_name }}</span></div>
				<div class="kv"><span>Email</span><span>{{ $customer->email ?? '-' }}</span></div>
				<div class="kv"><span>Telefono</span><span>{{ $customer->phone ?? '-' }}</span></div>
			</div>
		</section>

		<section class="section card">
			<div class="card-body">
				<h5>Permanenza</h5>
				<div class="kv"><span>Arrivo</span><span>{{ $customer->arrival_date ?? '-' }}</span></div>
				<div class="kv"><span>Partenza</span><span>{{ $customer->departure_date ?? '-' }}</span></div>
				<div class="kv"><span>Numero notti</span><span>{{ $customer->nights ?? '-' }}</span></div>
			</div>
		</section>

		<section class="section card">
			<div class="card-body">
				<h5>Riepilogo costi</h5>
				<div class="kv"><span>Costo totale soggiorno</span><span>{{ number_format($customer->total_stay_cost ?? 0, 2, ',', '.') }} €</span></div>
				<div class="kv"><span>Imposta di soggiorno</span><span>{{ number_format($cityTax ?? 0, 2, ',', '.') }} €</span></div>

				@if(!empty($additionalExpenses) && $additionalExpenses > 0)
					<div class="kv"><span>Totale spese aggiuntive</span><span>{{ number_format($additionalExpenses, 2, ',', '.') }} €</span></div>
					<div class="mt-2">
						<strong>Dettaglio spese:</strong>
						<ul class="list-unstyled ms-3 mt-1">
							@foreach($customer->expenses as $expense)
								<li>{{ ucfirst(str_replace('_', ' ', $expense->expense_type)) }}: {{ number_format($expense->amount, 2, ',', '.') }} €</li>
							@endforeach
						</ul>
					</div>
				@endif

				<hr>
				<div class="kv"><strong>Totale Complessivo</strong><strong>{{ number_format($grandTotal ?? 0, 2, ',', '.') }} €</strong></div>
				<div class="kv"><span>Acconto versato</span><span class="text-danger">- {{ number_format($customer->down_payment ?? 0, 2, ',', '.') }} €</span></div>
				<div class="kv"><strong>Saldo da pagare</strong><strong>{{ number_format($finalBalance ?? (($grandTotal ?? 0) - ($customer->down_payment ?? 0)), 2, ',', '.') }} €</strong></div>
			</div>
		</section>

		<footer class="mt-3 text-muted">
			<small>Pagina generata il {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</small>
		</footer>
	</div>
</body>
</html>
