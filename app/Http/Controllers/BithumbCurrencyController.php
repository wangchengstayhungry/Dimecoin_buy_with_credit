<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BithumbCurrencyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function getRealtimeCurrency() {
        // $units = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        $units = array('BTC', 'XRP', 'ETH', 'BCH', 'LTC', 'DASH', 'XMR', 'EOS', 'QTUM', 'BTG', 'ETC', 'ZEC');
        $result = array();
        foreach ($units as $key => $coin) {
            $data_json = file_get_contents("https://api.bithumb.com/public/ticker/".$coin);
            $data = json_decode($data_json);
            // dd($data->data->average_price);
            array_push($result, $data->data->closing_price);
        }
        return response()->json(['response' => $result]);
    }

    //get bithumb price from database
    public function getPriceDB() {
        $result = array();
        $prices = DB::table('bithumb_prices')->select('price')->get();
        foreach ($prices as $price) {
            array_push($result, $price->price);
        }
        return response()->json(['response' => $result]);
    }

    // set realtime bithumb price to database
    public function setPriceDB(Request $request) {
        $data_json = $request->input('send_data');       
        $data = json_decode($data_json);
        for($i = 0 ;$i < 12 ;$i++){
            DB::table('bithumb_prices')
            ->where('id', $i)
            ->update(['price' => $data[$i]]);
        }
        return response()->json(['response' => 'success']);
    }
}
