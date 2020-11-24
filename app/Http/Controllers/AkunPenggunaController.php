<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as Pengguna;

class AkunPenggunaController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
        $this->middleware('check.role.super.admin');
    }
    public function index()
    {
        if(session('user')['role'] != 'super admin'){
            return redirect()->back();
        }
        $params['menu'] = 'akun pengguna';
        $params['semuaPengguna'] = Pengguna::getDataPengguna();
        return view('content.akun-pengguna', $params);
    }
    public function add()
    {
        
        $params['menu'] = 'tambah akun pengguna';
        return view('content.tambah-akun-pengguna', $params);
    }
}
