@extends ('layouts.default')

@section ('page_title', 'Checkout')

@section ('content')

<div class="container">
	<div class="page-header">
		<h1>
			Checkout
		</h1> 
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Order Details</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<tbody>
								@foreach ($basket as $item)
									<tr>
										<td>
											<strong>{{ $item->name }}</strong>
										</td>
										<td class="text-right">
											x {{ $item->quantity }}
										</td>
										<td class="text-right">
											@if ($item->price != null && $item->price != 0)
												{{ Settings::getCurrencySymbol() }}{{ number_format($item->price, 2) }}
												@if ($item->price_credit != null && Settings::isCreditEnabled() && $item->price_credit != 0)
													/
												@endif
											@endif
											@if ($item->price_credit != null && Settings::isCreditEnabled() && $item->price_credit != 0)
												{{ number_format($item->price_credit, 2) }} Credits
											@endif
											Each
										</td>
										<td class="text-right">
											@if ($item->price != null && $item->price != 0)
												{{ Settings::getCurrencySymbol() }}{{ number_format($item->price * $item->quantity, 2) }}
												@if ($item->price_credit != null && Settings::isCreditEnabled() && $item->price_credit != 0)
													/
												@endif
											@endif
											@if ($item->price_credit != null && Settings::isCreditEnabled() && $item->price_credit != 0)
												{{ number_format($item->price_credit * $item->quantity, 2) }} Credits
											@endif
										</td>
									</tr>
								@endforeach
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right">
										<strong>Total:</strong>
										@if ($basket->total != null)
											{{ Settings::getCurrencySymbol() }}{{ number_format($basket->total, 2) }}
											@if ($basket->total_credit != null && Settings::isCreditEnabled())
												/
											@endif
										@endif
										@if ($basket->total_credit != null && Settings::isCreditEnabled())
											{{ number_format($basket->total_credit, 2) }} Credits
										@endif
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Payment</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						@foreach ($activePaymentGateways as $gateway)
							<div class="col-xs-12 col-md-6">
								<div class="section-header">
									<h4>
										{{ Settings::getPaymentGatewayDisplayName($gateway) }}
									</h4>
									<hr>
								</div>
								<a href="/payment/review/{{ $gateway }}">
									<button type="button" class="btn btn-primary btn-block">
										Pay by {{ Settings::getPaymentGatewayDisplayName($gateway) }}
									</button>
								</a>
								<p><small>{{ Settings::getPaymentGatewayNote($gateway) }}</small></p>
							</div>
						@endforeach
						@if (Settings::isCreditEnabled())
							<div class="col-xs-12 col-md-6">
								<div class="section-header">
									<h4>
										Credit
									</h4>
									<hr>
								</div>
								<a href="/payment/review/credit">
									<button type="button" class="btn btn-primary btn-block">
										Pay With Credit
									</button>
								</a>
								<p><small>Credit purchases are non refundable.</small></p>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection