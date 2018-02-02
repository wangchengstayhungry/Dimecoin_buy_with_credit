@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')

<div id="page-wrapper">
<div class="container">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Orders</h1>
        </div>
    </div>
    <div class="row" style="height: 50px;"></div>
    <div class="row">
    	<table class="table" id="users-table">
	        <thead>
	            <tr style="background-color: gainsboro;">
	                <th>Time Stamp</th>
	                <th>Number</th>
	                <th>Payment State</th>
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
        ajax: '{!! route('admin.neworders') !!}',
        columns: [
            { data: 'created_at', name: 'created_at' },
            { data: 'number', name: 'number' },
            { data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'email', name: 'email' }
        ]
    });
});
</script>
@endpush