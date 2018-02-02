<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Order;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendCompletionEmail;

class OrdersController extends Controller
{

	public function __construct()
    {
        // $this->middleware('auth:admins');
    }

    public function index()
    {
    	$menu = "orders";

        return view('admin.orders.lists', compact('menu'));
    }

    public function anyOrders() {
    	$order = Order::all();
        return Datatables::of($order)
            ->addColumn('action', function ($order) {
                return '<a href="orders/state/'.$order->id.'" class="btn btn-xs btn-warning">balance due</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
    public function completedOrdersView() {
        $menu = "orders";

        return view('admin.orders.completed', compact('menu'));
    }

    public function completedOrders() {
        $order = Order::where('status', 1)->get();
        $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        foreach ($order as $key => $item) {
            $item->coin_type = $coins[$item->coin_type];
        }
        return Datatables::of($order)
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function newOrdersView() {
        $menu = "orders";

        return view('admin.orders.new', compact('menu'));
    }

    public function newOrders() {
        $order = Order::where('status', 0)->get();
        return Datatables::of($order)
            ->addColumn('action', function ($order) {
                return '<a href="orders/state/'.$order->id.'" class="btn btn-xs btn-warning">balance due</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function stateView($id) {
    	$order = Order::where('id', $id)->first();
    	$user = User::where('id', $order->user_id)->first();
    	$menu = "orders";
    	$coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        // $proof_file = public_path('uploads').'/'.$user->proof_file;
        $proof_file = '/public/uploads/'.$user->proof_file;
        return view('admin.orders.state', compact('menu', 'order', 'user','coins', 'proof_file'));
    }

    public function stateSave(Request $request) {
    	$data = $request->input();       
        $result = DB::table('orders')->where('id', $data['id'])->update(
            ['dolla_amount' => $data['dolla_amount'], 'numberofcoin' => $data['numberofcoin'], 'status' => $data['status'], 'payment_method' => $data['payment_method'], 'completed_date' => date('m/d/Y')]
        );
        if($data['status'] == 1) {
            $order = Order::where('id', $data['id'])->first();
            $user = User::where('id', $order->user_id)->first();
            $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        	dispatch(new SendCompletionEmail($order,$user, $coins));
        	
        }
        return response()->json(['success' => true]);
    }
}
