<?php

namespace App\Http\Controllers;

use App\User;
use Yajra\Datatables\Datatables;
use App\Order;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendOrderEmail;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
               
    }

    public function makeOrder(Request $request) {
        $data = $request->input();       
        //save order into database
        $user_id = Auth::user()->id;
        $email = Auth::user()->email;
        $number = $this->getnumber();
        $result = DB::table('orders')->insert(
            ['user_id' => $user_id, 'wallet_address' => $data['wallet_address'], 'coin_type' => $data['coin_type'], 'status' => 0, 'number' => $number, 'email' => $email ]
        );
        if($result) {
            //send mail to user
            $payments = DB::table('payment_methods')->get();
            $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
            $coin_type = $coins[$data['coin_type']];
            $address = $data['wallet_address'];
            $data = array('coin_type' => $coin_type, 'address' => $address, 'number' => $number);
            dispatch(new SendOrderEmail(Auth::user(), $data, $payments));
            return response()->json(['response' => true]);
        } else {
            return response()->json(['response' => false]);
        }

        
    }

    function getnumber() {
        $a = '';
        for ($i = 0; $i<9; $i++) 
        {
            $a .= mt_rand(0,9);
        }
        return 'R'.$a;
    }

    function myOrders() {
        $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        $status_str = array('Ordered', 'Completed');
        $orders = Order::where('user_id', Auth::user()->id)->where('status',1)->get();
        foreach ($orders as $order) {
            $order->coin_type = $coins[$order->coin_type];
            $order->status = $status_str[$order->status];
        }
        return Datatables::of($orders)
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

}
