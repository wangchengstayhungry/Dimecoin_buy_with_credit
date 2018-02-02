@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')
<div id="page-wrapper">
<div class="container">
<form action="{{route('admin.settings.payment')}}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Setting / Payment Method</h1>
        </div>
    </div>
    <div class="row" style="height: 20px;"></div>
    <div class="row" id="payments_area">
        <?php $i=0; ?>
        <input type="hidden" name="payment_size" id="payment_size" value="<?=count($payments)?>">
        @foreach($payments as $payment)
            <?php $i++; ?>
            <div id="payment_element<?=$i?>">
                <div class="row">
                    <div class="col-lg-1">
                        <label>Method:</label>
                    </div>
                    <div class="col-lg-6">
                        <input class="payment_area" name="method[]" value="{{$payment->method}}">
                    </div>  
                </div>
                <div class="row" style="height: 10px;"></div>
                <div class="row">
                    <div class="col-lg-1">
                        <label>Text:</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea name="text[]" class="payment_method_text">{{$payment->text}}</textarea>
                    </div>  
                    <div class="col-lg-1">
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
            <button class="btn btn-primary" type="button" onclick="addNewpayment();">+ Add New payment</button>
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
    
    function addNewpayment(){
        var new_size = parseInt($("#payment_size").val()) + 1;
        var new_payment = '<div id="payment_element'+new_size+'"><div class="row"><div class="col-lg-1"><label>Method:</label></div><div class="col-lg-6"><input class="payment_area" name="method[]" value=""></div></div><div class="row" style="height: 10px;"></div><div class="row"><div class="col-lg-1"><label>Text:</label></div><div class="col-lg-6"><textarea name="text[]" class="payment_method_text"></textarea></div><div class="col-lg-1"><button type="button" class="btn btn-danger" style="margin-top: 10px;" onclick="removeRow('+ new_size +');">Remove</button></div></div><hr></div>';
        $("#payment_size").val(new_size);
        $("#payments_area").append(new_payment);
    } 

    function  removeRow(row) {
        $("#payment_element"+row).html('');
    }
</script>
@endsection