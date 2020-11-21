<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignOutController extends Controller
{
    public function signOut(Request $request)
    {
        $request->session()->forget('user');
        return redirect(url('/auth/signin'));
    }
}
