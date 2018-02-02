@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')

<div id="page-wrapper">
<div class="container">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
        </div>
    </div>
    <div class="row" style="height: 50px;"></div>
    <div class="row">
    	<table class="table table-bordered" id="users-table">
	        <thead>
	            <tr style="background-color: gainsboro;">
	                <th>Id</th>
	                <th>Email</th>
	                <th>Created At</th>
	                <th>Action</th>
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
        ajax: '{!! route('admin.anyusers') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush