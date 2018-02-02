
@extends('layouts.app')

@section('content')
<div class="container">
<div class="profile-body">
	<div class="row" style="height: 20px;"></div>
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<p class="container-title">Payment Methods</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10">
			@if(session()->has('message'))
		    <div class="alert alert-success">
		        {{ session()->get('message') }}
		    </div>
		@endif
		</div>
	</div>
	@foreach($payments as $payment)
	<div class="row">
		<div class="col-md-2">
			<p class="payment-title">{{$payment->method}}:</p>
		</div>
		<div class="col-md-10">
			<div class="row">
				<p class="payment-content"><?=nl2br($payment->text)?></p>	
			</div>
			
		</div>
	</div>
	<div class="row" style="height: 20px;"></div>
	@endforeach
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-10">
			<div class="row">
				<p class="payment-content">
					<a href="#" class="btn btn-default" style="float: left;margin-right: 20px;" onclick="document.getElementById('upload_payment_proof').click(); document.getElementById('upload_payment_proof').style.visibility = 'initial'; document.getElementById('uploadBtn').style.visibility = 'initial'; return false;" />Upload local file</a>
					Send us proof of payment in jpeg file
					<br>

				</p>
			</div>
				
			<div class="row">
			<form action="{{route('proofupload')}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="file"  name="upload_payment_proof" id="upload_payment_proof" style="visibility: hidden;float: left; margin-right: 20px;" />
				<button class="btn btn-primary" type="submit" id="uploadBtn" style="visibility: hidden;">Upload</button>
			</form>
			</div>
		</div>
	</div>
	
	
</div>
</div>

@endsection