<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
    	$menu = "users";
        return view('admin.users.lists', compact('menu'));
    }

    public function anyUsers()
	{
	    $users = User::where('user_type', 'user')->get();

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a href="users/edit/'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;<a href="users/remove/'.$user->id.'" class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')"><i class="glyphicon glyphicon-remove-sign"></i> Remove</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
	}

	public function edit($id) {
		$user = User::where('id', $id)->first();
		$detail = $user;
		$menu = "users";
        return view('admin.users.edit', compact('menu', 'user', 'detail'));
	}

	public function edit_save(Request $request, $id) {
		$data = $request->input();
        $result = DB::table('users')
            ->where('id', $id)
            ->update(['dob' => $data['dob'], 'address1' => $data['address1'], 'city' => $data['city'], 'province' => $data['province'], 'postal_code' => $data['postal_code'], 'telephone' => $data['telephone'], 'country' => $data['country'] ]);
            return redirect()->route('admin.users', compact('menu'));
	}

	public function remove($id) {
		$user = User::find($id);
	    $user->delete();
		$menu = "users";
        return redirect()->route('admin.users', compact('menu'));
	}

    public function adminSetting() {
        $info = DB::table('users')
            ->where('user_type', 'admin')
            ->first();
        $menu = "users";
        return view('admin.users.adminsetting', compact('menu', 'info'));   
    }

    public function adminSettingSave(Request $request) {
        $this->validate($request, [
            'email' => 'email',
            'password' => 'required|confirmed|min:6',
        ]);
        $data = $request->input();
        $info = DB::table('users')
            ->where('user_type', 'admin')
            ->update(['email' => $data['email'], 'password' => bcrypt($data['password'])]);
        return redirect()->route('admin.dashboard');
    }
}
