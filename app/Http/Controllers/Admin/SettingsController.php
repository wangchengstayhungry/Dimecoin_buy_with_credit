<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function social()
    {
    	$menu = 'settings';
        $discount = DB::table('setting')->where('type', 'discount')->first();
        $fb_link = DB::table('setting')->where('type', 'facebook')->first();
        $twit_link = DB::table('setting')->where('type', 'twitter')->first();
        $ins_link = DB::table('setting')->where('type', 'instagram')->first();
        return view('admin.settings.social', compact('menu', 'discount', 'fb_link', 'twit_link', 'ins_link'));
    }

    public function socialsave(Request $request) {
        $data = $request->input();
        DB::table('setting')->where('type','discount')->update(['value'=>$data['discount']]);
        DB::table('setting')->where('type','facebook')->update(['value'=>$data['fb_link']]);
        DB::table('setting')->where('type','twitter')->update(['value'=>$data['twit_link']]);
        DB::table('setting')->where('type','instagram')->update(['value'=>$data['ins_link']]);
        return redirect()->route('admin.settings.social');
    }

    public function payment() {
        $menu = 'settings';
        $payments = DB::table('payment_methods')->get();
        return view('admin.settings.payment', compact('menu', 'payments'));
    }

    public function paymentsave(Request $request) {
        $data = $request->input();
        //remove all existing rows in db
        DB::table('payment_methods')->delete();
        $i = 0;
        foreach ($data['method'] as $key => $value) {
            DB::table('payment_methods')->insert(['method' => $data['method'][$i] , 'text' => $data['text'][$i] ]);
            $i++;
        }
        return redirect()->route('admin.settings.payment');
    }

    public function faq() {
        $menu = 'settings';
        $faqs = DB::table('faqs')->get();
        return view('admin.settings.faq', compact('menu', 'faqs'));
    }

    public function faqsave(Request $request) {
        $data = $request->input();
        //remove all existing rows in db
        DB::table('faqs')->delete();
        $i = 0;
        foreach ($data['question'] as $key => $value) {
            DB::table('faqs')->insert(['question' => $data['question'][$i] , 'answer' => $data['answer'][$i] ]);
            $i++;
        }
        return redirect()->route('admin.settings.faq');
    }

    public function text() {
        $menu = 'settings';
        $texts = DB::table('texts')->get();
        return view('admin.settings.text', compact('menu', 'texts'));
    }

    public function textsave(Request $request) {
        $data = $request->input();
        DB::table('texts')->where('id', 1)->update(['text' => $data['text1']]);
        DB::table('texts')->where('id', 2)->update(['text' => $data['text2']]);
        return redirect()->route('admin.settings.text');
    }
}
