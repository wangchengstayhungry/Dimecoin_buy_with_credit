@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <form action="" method="post" id="price_form">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <p class="title">@lang('message.input_coin_address')</p>
                </div>
            </div>
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-md-6 col-md-offset-3">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="input" name="email" class="form-control" placeholder="@lang('message.input_coin_address')" id="email">        
                        </div>    
                        <div class="col-md-4">
                            <input type="button" name="button" class="btn btn-primary" value="@lang('message.order_now')" style="width: 100%;" onclick="on_started();">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
</div>

<div class="dashboard-body">
    <div class="container">
        <div class="col-md-3">
            <div class="row">
                <a href="{{route('profile')}}" class="walletinfo">@lang('message.profile')</a>    
            </div>
            <div class="row">
                <a href="{{route('walletinfo')}}" class="walletinfo">@lang('message.wallet_information')</a>    
            </div>
            <div class="row">
                <a href="{{route('transactions')}}" class="walletinfo">@lang('message.my_transactions')</a>    
            </div>
            <div class="row">
                <a href="{{route('paymentmethod')}}" class="walletinfo">@lang('message.payment_method')</a>    
            </div>
            <div class="row">
                <a href="{{route('faq')}}" class="walletinfo">FAQ</a>    
            </div>
            

        </div>
        <div class="col-md-6">
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="label-control">Coin</label>
                </div>

                <div class="col-md-8">
                    <select name="coin_type" id="coin_type" class="form-control" onchange="onCoinTypeChange();">
                        <?php for($i=0; $i<12;$i++) {?>
                            <option value="<?=$i?>">@lang($coins_str[$i])</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row heightspace-20"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="label-control">Wallet Address</label>
                </div>
                <div class="col-md-8">
                    <input type="input" name="wallet_address" id="wallet_address" class="form-control" value="">
                </div>
            </div>
        </div>
        <div class="row heightspace-20"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="label-control">Number of coin</label>
                </div>
                <div class="col-md-8">
                    <input type="input" name="numberofcoin" id="numberofcoin" class="form-control" value="" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="order-message" id="order_message"></p>
            </div>
        </div>
      </div>
      

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-order">Order now</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" name="discount" id="discount" value="{{$discount->value}}">
<script type="text/javascript">
var discount;
$(document).ready(function(){
    discount = parseFloat($("#discount").val());
    setPrice();
    //getRealtimePrice();
    setTimeout(getRealtimePrice, 5000);
});

function getRealtimePrice() {
    $.ajax({
        url: '/realtime_currency',
        method: 'GET',
        success: function(result) {
            var coin_currency = result.response;
            // console.log(coin_currency);
            for(i = 0; i < 12 ; i++) {
                var price = coin_currency[i];
                var our_price = parseInt(parseInt(price) * (1-discount*0.01));
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
    // if($("#email").val() == '') {
    //     $("#email").focus();
    //     return;
    // }
    if(confirm('Is this wallet address correct?')) {
        $("#wallet_address").val($("#email").val());
        $("#exampleModalCenter").modal('show');    
        onCoinTypeChange();
    }
    
}

$("#btn-order").click(function() {
    if($("#numberofcoin").val() == '') {
        $("#order_message").html('Please enter number of coin.');
        $("#order_message").attr("class", "order-message-error");
        return;
    }
    if($("#wallet_address").val() == '') {
        $("#order_message").html('Please enter wallet address.');
        $("#order_message").attr("class", "order-message-error");
        return;
    }
    $("#order_message").html('Ordering now...');
    $("#order_message").attr("class", "order-message");
    //order ajax call
    $.ajax({
                url: '/order',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'json',
                data: {
                    wallet_address: $("#wallet_address").val(),
                    coin_type: $("#coin_type").val(),
                    numberofcoin: $("#numberofcoin").val()
                },    
                success: function(res) {
                    // console.log(res);
                    if(res.response == true) {
                        $("#order_message").html('Your order has been successfully accepted. Thank you.');
                        $("#order_message").attr("class", "order-message");
                    } else {
                        $("#order_message").html('Your request has been failed. Please try again.');
                        $("#order_message").attr("class", "order-message-error");
                    }

                }
            });
});
function onCoinTypeChange() {
    var type = $("#coin_type").val();
    //find wallet address according to the coin type of user
    $.ajax({
        url: '/getwalletaddress',
        method: 'GET',
        data: {
            type: type
        },
        success: function(res) {
            var data = JSON.parse(res);
            if(data.response == "success") {
                $("#wallet_address").val(data.data);
                console.log(data.data);
            }
        }
    });
}
</script>
@endsection
