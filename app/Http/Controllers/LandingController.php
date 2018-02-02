<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index() {

        app()->setLocale(session('my_locale'));
    	if(Auth::User()) return redirect()->route('home');
    	$img_src = array("bitcoin.jpg", "ripple.jpg", "ethereum.jpg", "bitcoin_cash.jpg", "litecoin.jpg", "dash.jpg", "monero.jpg", "eos.jpg", "qtum.jpg", "bitcoin_gold.jpg", "ethereum_classic.jpg", "zcash.jpg");
        $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        // $coins_str = array('Bitcoin', 'Ripple', 'Ethereum', 'Bitcoin Cash', 'Litecoin', 'Dash', 'Monero', 'EOS', 'Qtum', 'Bitcoin Gold', 'Ethereum Classic', 'Zcash');
        $coins_str = array('message.bitcoin', 'message.ripple', 'message.ethereum', 'message.bitcoin_cash', 'message.litecoin', 'message.dash', 'message.monero', 'message.EOS', 'message.qtum', 'message.bitcoin_gold', 'message.ethereum_classic', 'message.zcash');
        $discount = DB::table('setting')->where('type', 'discount')->first();
        $fb_link = DB::table('setting')->where('type', 'facebook')->first();
        $twit_link = DB::table('setting')->where('type', 'twitter')->first();
        $ins_link = DB::table('setting')->where('type', 'instagram')->first();
    	return view('landing', compact('img_src', 'coins', 'coins_str', 'discount', 'fb_link', 'twit_link', 'ins_link'));
    }
}