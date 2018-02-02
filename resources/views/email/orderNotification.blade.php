<h1>Hello {{$user->first_name.' '.$user->last_name}}</h1>
You have made an order {{$data['number']}} on {{date('m/d/Y')}}
<p>Type of coin: {{$data['coin_type']}}</p>
<p>Wallet address:  {{$data['address']}}</p>
<p style="text-align: center;font-size: 20px;">Instructions</p>
<?php $i=0; ?>
<?php foreach($payments as $payment){ if($i==0) {$i++; continue;} ?>

	<p>{{$payment->method}}:</p>
	<p><?=nl2br($payment->text)?></p>
<?php } ?>
<p>Thank you</p>
<p>Bitnow.ca</p>