<h1>
	Hello {{$user->first_name.' '.$user->last_name}}
</h1>
<p>
	We accepted your order and the transaction is completed. Coin will be sent shortly.
</p>
<p>
	Wallet Address: {{$order->wallet_address}} <br>
	Amount($): {{$order->dolla_amount}} <br>
	Type Of Coin: {{$coins[$order->coin_type]}} <br>
	Number Of Coins: {{$order->numberofcoin}} <br>
	Completed Date: {{$order->completed_date}}

</p>
<p>
	Thank you.
</p>
<p>Bitnow.ca</p>