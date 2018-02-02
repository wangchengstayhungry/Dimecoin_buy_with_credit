<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalizationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function setLocalization(Request $request) {
        $data = $request->input();
        session(['my_locale' => $data['lang'] ]);
        app()->setLocale($data['lang']);
        \Config::set('app.locale', $data['lang']);
        return response()->json(['response' => \Config::get('app.locale')]);
    }
}