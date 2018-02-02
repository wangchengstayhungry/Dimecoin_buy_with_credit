<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Jobs\SendWalletVerificationEmail;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check wallet address is inputed or not
        // $wallet_status = DB::table('users')
        //              ->select('wallet_completed')
        //              ->where('id',Auth::user()->id)
        //              ->get()[0]->wallet_completed;
        // if(!$wallet_status) {
        //     return redirect()->route('walletinfo');
        // }
        // $img_src = array("bitcoin.jpg", "ripple.jpg", "ethereum.jpg", "bitcoin_cash.jpg", "litecoin.jpg", "dash.jpg", "monero.jpg", "eos.jpg", "qtum.jpg", "bitcoin_gold.jpg", "ethereum_classic.jpg", "zcash.jpg");
        // $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        // // $coins_str = array('Bitcoin', 'Ripple', 'Ethereum', 'Bitcoin Cash', 'Litecoin', 'Dash', 'Monero', 'EOS', 'Qtum', 'Bitcoin Gold', 'Ethereum Classic', 'Zcash');
        // $coins_str = array('message.bitcoin', 'message.ripple', 'message.ethereum', 'message.bitcoin_cash', 'message.litecoin', 'message.dash', 'message.monero', 'message.EOS', 'message.qtum', 'message.bitcoin_gold', 'message.ethereum_classic', 'message.zcash');
        // $discount = DB::table('setting')->where('type', 'discount')->first();
        // app()->setLocale(session('my_locale'));
        // return view('home', compact('img_src', 'coins', 'coins_str', 'discount'));

        $profile_status = DB::table('users')
                     ->select('profile_completed')
                     ->where('id',Auth::user()->id)
                     ->get()[0]->profile_completed;
        if(!$profile_status) {
            return redirect()->route('profile');
        }
        $img_src = array("bitcoin.jpg", "ripple.jpg", "ethereum.jpg", "bitcoin_cash.jpg", "litecoin.jpg", "dash.jpg", "monero.jpg", "eos.jpg", "qtum.jpg", "bitcoin_gold.jpg", "ethereum_classic.jpg", "zcash.jpg");
        $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        $coins_str = array('Bitcoin', 'Ripple', 'Ethereum', 'Bitcoin Cash', 'Litecoin', 'Dash', 'Monero', 'EOS', 'Qtum', 'Bitcoin Gold', 'Ethereum Classic', 'Zcash');
        $wallets = DB::table('wallets')
                     ->where('user_id', Auth::user()->id)
                     ->orderBy('coin_type')
                     ->get();
        $texts = DB::table('texts')->get();
        app()->setLocale(session('my_locale'));                     
        return view('wallets', compact('img_src', 'coins', 'coins_str', 'wallets', 'texts'));
    }

    public function profile_view() {
        app()->setLocale(session('my_locale'));
        $user = Auth::user();
        $detail = DB::table('users')
                     ->where('id',Auth::user()->id)
                     ->get()[0];
        return view('profile', compact('user', 'detail'));
    }

    public function profile_save(Request $request) {
        $data = $request->input();
        $result = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['dob' => $data['dob'], 'address1' => $data['address1'], 'city' => $data['city'], 'province' => $data['province'], 'postal_code' => $data['postal_code'], 'telephone' => $data['telephone'], 'country' => $data['country'] ]);
            DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['profile_completed' => 1]);
            return redirect()->route('home');
    }

    public function paymentmethod() {
        app()->setLocale(session('my_locale'));
        $payments = DB::table('payment_methods')->get();
        return view('paymentmethod', compact('payments'));
    }

    public function faq() {
        app()->setLocale(session('my_locale'));
        $faqs = DB::table('faqs')->get();
        return view('faq', compact('faqs'));
    }

    public function transactions() {
        app()->setLocale(session('my_locale'));
        return view('transactions');
    }

    public function proofupload(Request $request) {
        $this->validate($request, [
            'upload_payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('upload_payment_proof')) {
            $getimageName = time().'.'.$request->upload_payment_proof->getClientOriginalExtension();
            $request->upload_payment_proof->move(public_path('uploads'), $getimageName);
            //save to db
            DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['proof_file' => $getimageName]);
            ////
            return back()->with('message','File is Uploaded successfully');
        }
        else {
            return back()->with('message','File Uploading is failed');   
        }
    }

    public function walletinfo() {
        $img_src = array("bitcoin.jpg", "ripple.jpg", "ethereum.jpg", "bitcoin_cash.jpg", "litecoin.jpg", "dash.jpg", "monero.jpg", "eos.jpg", "qtum.jpg", "bitcoin_gold.jpg", "ethereum_classic.jpg", "zcash.jpg");
        $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
        $coins_str = array('Bitcoin', 'Ripple', 'Ethereum', 'Bitcoin Cash', 'Litecoin', 'Dash', 'Monero', 'EOS', 'Qtum', 'Bitcoin Gold', 'Ethereum Classic', 'Zcash');
        $wallets = DB::table('wallets')
                     ->where('user_id', Auth::user()->id)
                     ->orderBy('coin_type')
                     ->get();
        app()->setLocale(session('my_locale'));                     
        return view('wallets', compact('img_src', 'coins', 'coins_str', 'wallets'));
    }

    public function walletinfo_completed(Request $request) {
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['wallet_completed' => 1]);
            return redirect()->route('home');
    }

    public function walletinfobycoin(Request $request) {
        $data = $request->input();
        $address = DB::table('wallets')->where('user_id', Auth::user()->id)->where('coin_type', $data['coin_id'])->first();
        if($address){
            return json_encode(array('response' => $address->address));
        }else {
            return json_encode(array('response' => ''));
        }
    }

    public function walletinfoSave(Request $request) {
        $wallet_address = $request->input('wallet_address');
        $coin_type = $request->input('coin_type');
        //check if address is already exist or not
        $wallet_info = DB::table('wallets')
                     ->where('user_id',Auth::user()->id)
                     ->where('coin_type', $coin_type)
                     ->first();
        if($wallet_info != null) {
            //update
            $result = DB::table('wallets')
                     ->where('user_id',Auth::user()->id)
                     ->where('coin_type', (int)$coin_type)
                     ->update(['address' => $wallet_address]);
        } else {
            //insert
            $result = DB::table('wallets')
                     ->insert(['user_id' => Auth::user()->id, 'coin_type' => $coin_type,'address' => $wallet_address]);
        }
       
            $message = "success";
            $coins = array('BTC', 'ETH', 'DASH', 'LTC', 'ETC', 'XRP', 'BCH', 'XMR', 'ZEC', 'QTUM', 'BTG', 'EOS');
            $user = User::where('id', Auth::user()->id)->first();
            dispatch(new SendWalletVerificationEmail($user, $wallet_address, $coins[$coin_type]));
       
        return json_encode(array('response' => $message));
    }

    public function getwalletaddress(Request $request) {
        $data = $request->input();
        $coin_type = $data['type'];
        $wallet_info = DB::table('wallets')
                     ->where('user_id',Auth::user()->id)
                     ->where('coin_type', $coin_type)
                     ->first();
        if($wallet_info && count($wallet_info) > 0) {
            return json_encode(array('response' => 'success', 'data' => $wallet_info->address));             
        }
        else {
            return json_encode(array('response' => 'failed', 'data' => ''));                
        }
    }

}
