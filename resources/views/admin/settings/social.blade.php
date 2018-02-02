@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')
<div id="page-wrapper">
<div class="container">
<form action="{{route('admin.settings.social')}}" method="post">
	{{ csrf_field() }}
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Setting</h1>
        </div>
    </div>
    <div class="row" style="height: 20px;"></div>
    <div class="row">
    	<div class="col-md-1">
    		<label>Discount:</label>	
    	</div>
    	<div class="col-md-3">
    		<input type="input" style="text-align: right;" class="form-control" name="discount" value="{{$discount->value}}">
    	</div>
    	<p style="padding-top: 5px;">%</p>
    </div>
    <hr>
    <div class="row">
    	<div class="col-md-2">
    		<label>Facebook Link:</label>	
    	</div>
    	<div class="col-md-4">
    		<input type="input" name="fb_link" value="{{$fb_link->value}}" class="form-control">	
    	</div>
    </div>
    <div class="row" style="height: 20px;"></div>
    <div class="row">
    	<div class="col-md-2">
    		<label>Twitter Link:</label>	
    	</div>
    	<div class="col-md-4">
    		<input type="input" name="twit_link" value="{{$twit_link->value}}" class="form-control">	
    	</div>
    </div>
    <div class="row" style="height: 20px;"></div>
    <div class="row">
    	<div class="col-md-2">
    		<label>Instagram Link:</label>	
    	</div>
    	<div class="col-md-4">
    		<input type="input" name="ins_link" value="{{$ins_link->value}}" class="form-control">	
    	</div>
    </div>
    <hr>
    <div class="row">
    	<div class="col-md-1 col-md-offset-2">
    		<button type="submit" class="btn btn-primary">Save Changes</button>
    	</div>
    </div>
</form>
</div>
</div>
@endsection