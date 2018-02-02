@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')
<div id="page-wrapper">
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><a href="{{route('admin.users')}}">Users </a>/ Edit</h1>
    </div>
</div>
<div class="row" style="height: 20px;"></div>	
<form action="/backend/users/edit/{{$user->id}}" method="post">
    {{ csrf_field() }}
    <div class="row">        
        <div class="col-md-6 profile-body">
            <div class="form-group">
                <label>Legal Name</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="input" class="form-control" name="first_name" value="{{$user->first_name}}" readonly>
                    </div>
                    <div class="col-md-6">
                        <input type="input" class="form-control" name="last_name" value="{{$user->last_name}}" readonly>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label>Email: {{$user->email}}</label>

            </div>

            <div class="form-group">
                <label>Date of bith</label>
                <div class='input-group date' id='dob'>
                    <input type='text'  name="dob" class="form-control" value="<?=isset($detail->dob) ? $detail->dob : '01/01/2018' ?>"/>
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label>Street address1</label>
                <input type="input" name="address1" class="form-control" placeholder="Street address 1" value="<?=isset($detail->address1) ? $detail->address1 : '' ?>" required>
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="input" name="city" class="form-control" placeholder="City" value="<?=isset($detail->city) ? $detail->city : '' ?>" required>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Province</label>
                        <input type="input" class="form-control" name="province" value="<?=isset($detail->province) ? $detail->province : '' ?>" placeholder="Province" required>
                    </div>
                    <div class="col-md-6">
                        <label>Postal code</label>
                        <input type="input" class="form-control" name="postal_code" value="<?=isset($detail->postal_code) ? $detail->postal_code : '' ?>" placeholder="Postal code" required>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                         <label>Telephone</label>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="input" name="telephone" class="form-control" value="<?=isset($detail->telephone) ? $detail->telephone : '' ?>" required>
                    </div>    
                </div>
                
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Country</label>    
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="input" name="country" class="form-control" value="<?=isset($detail->country) ? $detail->country : 'Canada' ?>" required>
                    </div>
                </div>
                
                
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save </button>
            </div>
        </div>
    </div>
</form>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#dob").datepicker({
        format: 'mm/dd/yyyy',
        todayHighlight: true,
        autoclose: true,
    });
});
</script>
	
@endsection