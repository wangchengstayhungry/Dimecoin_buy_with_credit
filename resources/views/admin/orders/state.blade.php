@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="page-wrapper">
<div class="container state">
	<form action="" method="post" id="price_form">
		{{ csrf_field() }}
	</form>
	<div class="row">
        <div class="col-lg-12">
             <h1 class="page-header"><a href="{{route('admin.orders.new')}}">Orders </a>/ {{ $order->number }}</h1>
        </div>
    </div>
    <div class="row" style="height: 20px;"></div>	
    <div class="row">
		<table class="table table-bordered">
			<thead>
				<th>Date/Time</th>
				<th>Type of Coin</th>
				<th>Wallet Address</th>
				<th>Number of coins</th>
				<th>Amount($)</th>
				<th>Payment Method</th>
				<th>Payment State</th>
				<th>Action</th>
			</thead>
			<tbody>
				<tr>
					<input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
					
					<td>{{$order->created_at}}</td>
					
					<td>{{$coins[$order->coin_type]}}</td>
					<td>{{$order->wallet_address}}</td>
					<td><input type="input" name="numberofcoin" id="numberofcoin" style="width: 100px;"  value="{{$order->numberofcoin}}"></td>
					<td><input type="input" name="dolla_amount" id="dolla_amount" style="width: 100px;"  value="{{$order->dolla_amount}}"></td>
					<td>
						<input type="input" name="payment_method" id="payment_method" value="{{$order->payment_method}}"></td>
					</td>
					<td>
						<div class="form-check">
							<label style="font-size: 30px;">
								<input type="checkbox" name="status_check" id="status_check" @if($order->status==1) checked @endif> <span class="label-text"></span>
							</label>
						</div>
					</td>
					<td><button type="button" class="btn btn-primary" onclick="onStatusSave();" @if($order->status==1) disabled @endif>Save</button> </td>
				</tr>
				<tr>
					<td colspan="1">
						Date Completed:
					</td>
					<td colspan="2">
						{{$order->completed_date}}
					</td>
				</tr>
				

			</tbody>
		</table>
	</div>
	<div class="row">
		<label>If you want to see payment proof file, Please click <a href="#" onclick="on_proof_file();">here</a></label>
	</div>
	<div class="row">
		<div id="proof_file" style="display: none;">
			<a href="{{$proof_file}}" target="_blank"><img src="{{$proof_file}}" class="proof_file"></a> 
		</div>
	</div>
	<div id="loading_bar" style="display: none;">
		<div class="loader"></div>	
	</div>
	
</div>

</div>

<script type="text/javascript">
	function on_proof_file() {
		$("#proof_file").attr('style', 'display:inherit');
	}

	function onStatusSave() {
		if(confirm('Are you agree to save changes?')) {
			var cash_check = 0, bank_check = 0, paypal_check = 0, status_check= 0;
			if ($('#status_check').is(":checked")) status_check = 1;
			$("#loading_bar").attr("style", "display: inherit;");
			$.ajax({
                url: 'save',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'json',
                data: {
                	id: $("#order_id").val(),
                    dolla_amount: $("#dolla_amount").val(),
                    payment_method: $("#payment_method").val(),
                    numberofcoin: $("#numberofcoin").val(),
                    status: status_check

                },    
                success: function(res) {
                	$("#loading_bar").attr("style", "display: none;");
                    location.reload();

                }
            });
		}
	}
</script>

@endsection