@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')

<div id="page-wrapper">
<div class="container">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Completed Orders</h1>
        </div>
    </div>
    <div class="row" style="height: 50px;"></div>
    <div class="row">
    	<table class="table" id="users-table">
	        <thead>
	            <tr style="background-color: gainsboro;">
	                <th>Time Stamp</th>
	                <th>Order Number</th>
	                <th>Type of coin</th>
                    <th>Coin Address</th>
                    <th>Number of Coins</th>
                    <th>Amount($)</th>
	                <th>Customer Email</th>
	            </tr>
	        </thead>
	    </table>
    </div>
</div>	
    
</div>
@endsection
@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.completedorders') !!}',
        columns: [
            { data: 'created_at', name: 'created_at' },
            { data: 'number', name: 'number' },
            { data: 'coin_type', name: 'coin_type' },
            { data: 'wallet_address', name: 'wallet_address' },
            { data: 'numberofcoin', name: 'numberofcoin' },
            { data: 'dolla_amount', name: 'dolla_amount' },
            { data: 'email', name: 'email' }
        ]
    });
});
</script>
@endpush