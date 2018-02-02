@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')
<div id="page-wrapper">
<div class="container">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reports</h1>
        </div>
    </div>
    <div class="row" style="height: 20px;"></div>
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">
    		<div class="row">
    			<div class="col-md-6">
    				<label class="form-group">Date Range</label>
    			</div>
    		</div>
    		<div class="row">
            <form action="{{route('admin.reports.search')}}" method="post">
                {{ csrf_field() }}
    			<div class="col-md-4">
	    			<div class='input-group date' id='start_date'>
	                    <input type='text'  name="start_date" class="form-control" value="<?=isset($start_date) ? $start_date : '01/01/2018' ?>"/>
	                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
	                </div>
	    		</div>
	    		<div class="col-md-4">
	    			<div class='input-group date' id='end_date'>
	                    <input type='text'  name="end_date" class="form-control" value="<?=isset($end_date) ? $end_date : date('m/d/Y') ?>"/>
	                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
	                </div>
	    		</div>
	    		<div class="col-md-2">
	    			<button class="btn btn-primary" type="submit">Search</button>
	    		</div>
            </form>
    		</div>
    		
    	</div>
    </div>
    <div class="row" style="height: 30px;"></div>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <th class="text-align-center">Coin</th>
                    <th class="text-align-center">Total Sales</th>
                </thead>
                <tbody>
                    <?php for($i=0; $i<12;$i++) {?>
                    <tr>
                        <td class="text-align-left">
                            <img src="{{asset('img/'.$img_src[$i])}}" class="coin-img">
                        {{$coins_str[$i]}}</td>
                        <td class="text-align-right"  id="">{{number_format($total_amount[$i],0,".",",")}}원</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
    	</div>
    </div>
</div>	
<script type="text/javascript">
$(document).ready(function(){
    $("#start_date").datepicker({
        format: 'mm/dd/yyyy',
        todayHighlight: true,
        autoclose: true,
    });
    $("#end_date").datepicker({
        format: 'mm/dd/yyyy',
        todayHighlight: true,
        autoclose: true,
    });
});
</script>
@endsection