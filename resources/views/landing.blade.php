@extends('layouts.app')

@section('content')
<div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <p class="title">@lang('message.buy_digital_currency')</p>
                </div>
            </div>
           
        </div>
    <div class="row" style="height: 50px;"></div>
</div>

<div class="dashboard-body">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <table class="table table-bordered">
                <thead>
                    <th class="text-align-center">@lang('message.coin')</th>
                    <th class="text-align-center">@lang('message.bithumb_prices')</th>
                    <th class="text-align-center our_prices">@lang('message.our_prices')</th>
                </thead>
                <tbody>
                    <?php for($i=0; $i<12;$i++) {?>
                    <tr>
                        <td class="text-align-left">
                            <img src="{{asset('img/'.$img_src[$i])}}" class="coin-img">
                        @lang($coins_str[$i])</td>
                        <td class="text-align-right" id="bithumb_price_{{$i}}"></td>
                        <td class="text-align-right our_prices"  id="our_price_{{$i}}"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
            
    </div>
        
</div>
<div class="container">
<div class="footer">
    <a href="{{$fb_link->value}}" target="_blank"><img src="{{asset('img/fb-art.jpg')}}" class="social-media-img"> </a>
    <a href="{{$twit_link->value}}" target="_blank"><img src="{{asset('img/twitter-art.jpg')}}" class="social-media-img"></a>
    <a href="{{$ins_link->value}}" target="_blank"><img src="{{asset('img/instagram-art.jpg')}}" class="social-media-img"></a>
</div>
</div>
<input type="hidden" name="discount" id="discount" value="{{$discount->value}}">

<script type="text/javascript">
var discount;
$(document).ready(function(){
    discount = parseFloat($("#discount").val());
    setPrice();
    //getRealtimePrice();
    setTimeout(getRealtimePrice, 10000);
});
function getRealtimePrice() {
    //alert("sss");
    $.ajax({
        url: '/realtime_currency',
        method: 'GET',
        success: function(result) {
            var coin_currency = result.response;
            console.log(coin_currency);
            for(i = 0; i < 12 ; i++) {
                var price = coin_currency[i];
                var our_price = parseInt(parseInt(price) * (1-discount*0.01) );
                $("#bithumb_price_"+i).html(changeNumberFormat(price.toString())+"@lang('message.won')");
                $("#our_price_"+i).html(changeNumberFormat(our_price.toString())+"@lang('message.won')");
            }
            // ////////////////////////////////
            $.ajax({
                url: '/realtime_currency_dbset',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'json',
                data: {send_data: JSON.stringify(coin_currency)},    
                success: function(res) {
                    // console.log(res);
                }
            });
        }
    });
    setTimeout(getRealtimePrice, 10000);
}


function setPrice() {
    $.ajax({
        url: '/realtime_currency_db',
        method: 'GET',
        success: function(res) {
            var coin_currency = res.response;
            // console.log(coin_currency);
            for(i = 0; i < 12 ; i++) {
                var price = coin_currency[i];
                var our_price = parseInt(parseInt(price) * (1-discount*0.01));
                $("#bithumb_price_"+i).html(changeNumberFormat(price.toString())+"@lang('message.won')");
                $("#our_price_"+i).html(changeNumberFormat(our_price.toString())+"@lang('message.won')");
            }
        }
    });
}

function on_submit() {
    setTimeout(getRealtimePrice, 0);
    $("#price_form").submit();
}

function changeNumberFormat(str) {
    x = str.split('.'); 
    x1 = x[0];
    var rgx = /(\d+)(\d{3})/; 
    while (rgx.test(x1)) { 
        x1 = x1.replace(rgx, '$1' + ',' + '$2'); 
    } 
    return x1;
}


function on_started() {
    alert("Please sign in first.");
    // if($("#email").val() == '') {
    //     $("#email").focus();
    //     return;
    // }
    // $("#wallet_address").val($("#email").val());
    // $("#exampleModalCenter").modal('show');
}



</script>
@endsection
