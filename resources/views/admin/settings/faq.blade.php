@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')
<div id="page-wrapper">
<div class="container">
<form action="{{route('admin.settings.faq')}}" method="post">
	{{ csrf_field() }}
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Setting / FAQ</h1>
        </div>
    </div>
    <div class="row" style="height: 20px;"></div>
    <div class="row" id="faqs_area">
    	<?php $i=0; ?>
    	<input type="hidden" name="faq_size" id="faq_size" value="<?=count($faqs)?>">
    	@foreach($faqs as $faq)
    		<?php $i++; ?>
    		<div id="faq_element<?=$i?>">
    			<div class="row">
	    			<div class="col-lg-2">
	    				<label>Q:</label>
		    		</div>
		    		<div class="col-lg-6">
		    			<textarea class="faq_area" name="question[]">{{$faq->question}}</textarea>
		    		</div>	
	    		</div>
	    		<div class="row" style="height: 10px;"></div>
	    		<div class="row">
	    			<div class="col-lg-2">
	    				<label>A:</label>
		    		</div>
		    		<div class="col-lg-6">
		    			<textarea class="faq_area" name="answer[]">{{$faq->answer}}</textarea>
		    		</div>	
		    		<div class="col-lg-2">
		    			<button type="button" class="btn btn-danger" style="margin-top: 10px;" onclick="removeRow(<?=$i?>);">Remove</button>
		    		</div>
	    		</div>
	    		<hr>
    		</div>
	    		
    	@endforeach
    		
    </div>
    <div class="row" style="height: 10px;"></div>
	<div class="row">
		<div class="col-lg-2 col-lg-offset-8">
			<button class="btn btn-primary" type="button" onclick="addNewFaq();">+ Add New FAQ</button>
		</div>
	</div>
	<hr>
    <div class="row" style="height: 40px;"></div>
	<div class="row">
		<div class="col-lg-2 col-lg-offset-3">
			<button class="btn btn-primary" type="submit">Save Changes</button>
		</div>
	</div>
    
</form>
</div>
</div>
<script type="text/javascript">
	
	function addNewFaq(){
		var new_size = parseInt($("#faq_size").val()) + 1;
		var new_faq = '<div id="faq_element'+new_size+'"><div class="row"><div class="col-lg-2"><label>Q:</label></div><div class="col-lg-6"><textarea class="faq_area" name="question[]"></textarea></div></div><div class="row" style="height: 10px;"></div><div class="row"><div class="col-lg-2"><label>A:</label></div><div class="col-lg-6"><textarea class="faq_area" name="answer[]"></textarea></div><div class="col-lg-2"><button type="button" class="btn btn-danger" style="margin-top: 10px;"  onclick="removeRow('+new_size+');">Remove</button></div></div><hr></div>';
		$("#faq_size").val(new_size);
		$("#faqs_area").append(new_faq);
	} 

	function  removeRow(row) {
		$("#faq_element"+row).html('');
	}
</script>
@endsection