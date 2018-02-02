<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
    	$menu = "reports";
    	$img_src = array("bitcoin.jpg", "ripple.jpg", "ethereum.jpg", "bitcoin_cash.jpg", "litecoin.jpg", "dash.jpg", "monero.jpg", "eos.jpg", "qtum.jpg", "bitcoin_gold.jpg", "ethereum_classic.jpg", "zcash.jpg");
        $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        $coins_str = array('Bitcoin', 'Ripple', 'Ethereum', 'Bitcoin Cash', 'Litecoin', 'Dash', 'Monero', 'EOS', 'Qtum', 'Bitcoin Gold', 'Ethereum Classic', 'Zcash');
        $total_amount  = array();
        for ($i=0; $i < 12 ; $i++) { 
            $result = DB::table('orders')
                ->where('coin_type', $i)
                ->select(DB::raw('SUM(amount) as total_amount'))
                ->get();
            array_push($total_amount, $result[0]->total_amount);
        }
        return view('admin.reports', compact('menu','img_src', 'coins', 'coins_str', 'total_amount'));
    }

    public function search(Request $request) {
        $data = $request->input();
        $menu = "reports";
        $img_src = array("bitcoin.jpg", "ripple.jpg", "ethereum.jpg", "bitcoin_cash.jpg", "litecoin.jpg", "dash.jpg", "monero.jpg", "eos.jpg", "qtum.jpg", "bitcoin_gold.jpg", "ethereum_classic.jpg", "zcash.jpg");
        $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        $coins_str = array('Bitcoin', 'Ripple', 'Ethereum', 'Bitcoin Cash', 'Litecoin', 'Dash', 'Monero', 'EOS', 'Qtum', 'Bitcoin Gold', 'Ethereum Classic', 'Zcash');
        $total_amount  = array();
        $date=date_create($data['start_date']);
        $start_date0 = date_format($date,"Y/m/d H:i:s");
        $date=date_create($data['end_date']);
        $end_date0 = date_format($date,"Y/m/d H:i:s");
        for ($i=0; $i < 12 ; $i++) { 
            $result = DB::table('orders')
                ->where('coin_type', $i)
                ->whereBetween('created_at', [$start_date0, $end_date0])
                ->select(DB::raw('SUM(amount) as total_amount'))
                ->get();
            array_push($total_amount, $result[0]->total_amount);
        }
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        return view('admin.reports', compact('menu','img_src', 'coins', 'coins_str', 'total_amount', 'start_date', 'end_date'));
    }
}
