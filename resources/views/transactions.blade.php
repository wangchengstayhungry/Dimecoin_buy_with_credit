@extends('layouts.app')

@section('content')
<div class="container">
	<div class="profile-body">
		<div class="row" style="height: 20px;"></div>
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				<p class="container-title">Transactions</p>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered" id="myorders-table">
				<thead>
					<tr style="background-color: gainsboro;">
						<th>Date</th>
						
						<th>Type of Coin</th>
						<th>Coin Address</th>
						<th>Number Of Coin</th>
						<th>Amount($)</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	
</div>
<script>
$(function() {
    $('#myorders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('order.myorders') !!}',
        columns: [
            { data: 'completed_date', name: 'completed_date' },
            { data: 'coin_type', name: 'coin_type' },
            { data: 'wallet_address', name: 'wallet_address' },
             { data: 'numberofcoin', name: 'numberofcoin' },
			{ data: 'dolla_amount', name: 'dolla_amount' },
        ]
    });
});
</script>
@endsection