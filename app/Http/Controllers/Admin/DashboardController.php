<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
class DashboardController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
    	$menu = "dashboard";
    	$img_src = array("bitcoin.jpg", "ripple.jpg", "ethereum.jpg", "bitcoin_cash.jpg", "litecoin.jpg", "dash.jpg", "monero.jpg", "eos.jpg", "qtum.jpg", "bitcoin_gold.jpg", "ethereum_classic.jpg", "zcash.jpg");
        $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        $coins_str = array('Bitcoin', 'Ripple', 'Ethereum', 'Bitcoin Cash', 'Litecoin', 'Dash', 'Monero', 'EOS', 'Qtum', 'Bitcoin Gold', 'Ethereum Classic', 'Zcash');
        $users = User::all();
        $completed_orders = Order::where('status',1)->get();
        $new_orders = Order::where('status',0)->get();
        return view('admin.dashboard', compact('menu', 'img_src', 'coins', 'coins_str', 'users', 'completed_orders' ,'new_orders'));
    }
}
