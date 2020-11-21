<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as Pengguna;

class AkunPenggunaController extends Controller
{
    public function index()
    {
        $params['menu'] = 'akun pemancing';
        $params['semuaPengguna'] = Pengguna::getDataPengguna();
        return view('content.akun-pengguna', $params);
    }
    public function add()
    {
        
        $params['menu'] = 'tambah akun pengguna';
        return view('content.tambah-akun-pengguna', $params);
    }
}
