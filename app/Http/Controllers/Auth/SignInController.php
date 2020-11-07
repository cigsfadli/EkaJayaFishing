<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class SignInController extends Controller
{

    
    public function __construct(){
        $this->middleware('check.session');
    }

    public function index(){
        $params['page'] = 'Sign In Page';
        return view('auth.sign-in', $params);
    }

    public function signIn(Request $request){
        $username = $request->post('username');
        $password = $request->post('password');

        $user = DB::table('users')->where('username', $username)->get()->first();
        if (!isset($user)) {
            return redirect()->back()->withErrors(['err' => 'Penguna Tidak Ditemukan !']);
        }
        if (Hash::check($password, $user->password)) {
            $user = [
                'user_id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'role' => $user->role
            ];
            session(['user' => $user]);
            return redirect(url('/'));
        }else{
            return redirect()->back()->withErrors(['err' => 'Password Salah !']);
        }
    }
}
