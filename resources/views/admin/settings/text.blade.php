@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')
<div id="page-wrapper">
<div class="container">
	<form action="{{route('admin.settings.text')}}" method="post">
		{{ csrf_field() }}
		<div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Setting / Texts</h1>
	        </div>
	    </div>
	    <div class="row" style="height: 20px;"></div>
	    <div class="row" id="faqs_area">
	    	<div class="row">
    			<div class="col-lg-2">
    				<label>Warning 1:</label>
	    		</div>
	    		<div class="col-lg-6">
	    			<textarea class="faq_area" name="text1">{{$texts[0]->text}}</textarea>
	    		</div>	
    		</div>
	    </div>
	    <div class="row" style="height: 20px;"></div>
	    <div class="row" id="faqs_area">
	    	<div class="row">
    			<div class="col-lg-2">
    				<label>Warning 2:</label>
	    		</div>
	    		<div class="col-lg-6">
	    			<textarea class="payment_method_text" name="text2">{{$texts[1]->text}}</textarea>
	    		</div>	
    		</div>
	    </div>
	    <div class="row" style="height: 40px;"></div>
		<div class="row">
			<div class="col-lg-2 col-lg-offset-3">
				<button class="btn btn-primary" type="submit">Save Changes</button>
			</div>
		</div>
	</form>
</div>
</div>
@endsection