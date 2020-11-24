<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilController extends Controller
{
    public function index()
    {
        $user = session('user');
        $params['page'] = "Profile Page";
        $params['user'] = User::where('id', $user['user_id'])->first();
        
        return view('auth.profil', $params);

        
    }
}
