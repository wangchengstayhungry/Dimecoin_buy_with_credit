@extends('layouts.app')

@section('content')
<div class="container">


	<div class="profile-body">
		<div class="row" style="height: 50px;"></div>
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				<p class="container-title">Wallet Information</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<table class="table table-bordered" id="myorders-table">
						<thead>
							<tr style="background-color: gainsboro;">
								<th>Coin</th>
								<th>Wallet Address</th>
								<th>Save</th>
							</tr>
						</thead>
						<tbody>
							<?php for($i=0; $i<12;$i++) {?>
		                    <tr>
		                        <td style="width: 30%;" class="text-align-left" >
		                            <img src="{{asset('img/'.$img_src[$i])}}" class="coin-img">
		                        {{$coins_str[$i]}}</td>
		                        <td style="width: 50%;padding: 0 0;" class="text-align-left" ><input style="width: 100%;height: 40px;padding: 10px;" type="input" name="wallet_address<?=$i?>" id="wallet_address<?=$i?>" @if(isset($wallets[$i])) value="{{$wallets[$i]->address}}" @endif></td>
		                        <td style="width: 10%;text-align: center;"><button type="button" class="btn btn-primary" onclick="save_wallet_address({{$i}});">START</button></td>
		                    </tr>
		                    <?php } ?>
						</tbody>
					</table>
				</div>
				
			</div>
			<div class="col-md-6" >
				
				<div class="row" style="height: 50px;"></div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<p class="notice-danger" style="font-size: 25px;">{{$texts[0]->text}}</p>	
					</div>
					
				</div>
				<div class="row" style="height: 50px;"></div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div style="margin-top: 50px;">
                            <p class="notice-default"><?=nl2br($texts[1]->text)?></p>
							<!-- <p class="notice-default">**** Please make sure it is the correct wallet ****</p>
							<p class="notice-default">**** Please double check all wallet information ****</p>
							<p class="notice-danger">**** Bitnow does not take responsibility for when the wallet is incorrect ****</p>
							<p class="notice-danger">**** When you update or save wallet address, please confirm on your email ****</p> -->
						</div>
					</div>
				</div>
			</div>	
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
                    <input name="coin_type" id="coin_type" class="form-control" disabled>    
                    <input name="coin_type_int" type="hidden" id="coin_type_int">    
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
                    <input type="input" name="wallet_address" id="wallet_address" class="form-control" value="" disabled>
                </div>
            </div>
        </div>
        <div class="row heightspace-20"></div>
        <div class="row">
            <div class="col-md-12">
                <p style="font-size: 17px;">Is this wallet address correct? The confirm email has been sent to this wallet address. Please check your email. Please click the order button if this wallet address is correct.</p>
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
<script type="text/javascript">
	var selected_coin_type;
	function save_wallet_address(n) {
		var address = $("#wallet_address"+n).val();
		if(address == '') {
			alert('Please enter correct wallet address');
			return false;
		}
        selected_coin_type = n;
		// if(confirm('Is this wallet address correct?')) {
					var coins = ['BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS'];
					$("#wallet_address").val(address);
					$("#coin_type").val(coins[n]);
					$("#coin_type_int").val(n);
					$("#exampleModalCenter").modal('show');
			//save wallet address
			$.ajax({
                url: '/walletinfosave',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'json',
                data: {
                    wallet_address: address,
                    coin_type: n
                },    
                success: function(res) {
                    console.log(res);
                    var coins = ['BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS'];
                	$("#wallet_address").val(address);
                    $("#coin_type").val(coins[selected_coin_type]);
                    $("#coin_type_int").val(selected_coin_type);
                    $("#exampleModalCenter").modal('show');
                }
            });
		// }

	}

	function onSelectCoin(n) {
		selected_coin_type = n;
		$.ajax({
                url: '/walletinfobycoin',
                type: 'GET',
                data: {
                	coin_id: n
                },
                success: function(res) {
                	var data = JSON.parse(res);
                	$("#confirm_address").val(data.response);
                }
            });
	}

	// function onStart() {
	// 	if($("#confirm_address").val() == '') {
	// 		alert("Please enter correct wallet address.");
	// 		return;
	// 	} else {
	// 		var coins = ['BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS'];
	// 		$("#wallet_address").val($("#confirm_address").val());
	// 		$("#coin_type").val(coins[selected_coin_type]);
	// 		$("#coin_type_int").val(selected_coin_type);
	// 		$("#exampleModalCenter").modal('show');
	// 	}
		
	// }

$("#btn-order").click(function() {
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
                    coin_type: $("#coin_type_int").val(),
                    numberofcoin: $("#numberofcoin").val()
                },    
                success: function(res) {
                    // console.log(res);
                    if(res.response == true) {
                        $("#order_message").html('Your order has been successfully accepted. Thank you.');
                        $("#order_message").attr("class", "order-message");
                        // go to payment method page
                        window.location.href = "/paymentmethod";

                    } else {
                        $("#order_message").html('Your request has been failed. Please try again.');
                        $("#order_message").attr("class", "order-message-error");
                    }

                }
            });
});
</script>
@endsection