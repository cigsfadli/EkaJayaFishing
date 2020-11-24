<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemancing;
use App\Models\Rekap;
use App\Models\TransaksiTagihan;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
        $this->middleware('check.role.admin');
        
    }
    

    public function index(Request $request)
    {
        $params['menu'] = 'dashboard'; 
        $params['jumlah_pemancing'] = Pemancing::all()->count();
        $params['jumlah_rekap'] = Rekap::all()->count();
        $params['pendapatan'] = 0;

        foreach ( Pemancing::all() as $pemancing) {
            $params['pendapatan'] += (TransaksiTagihan::where('id_pemancing', $pemancing->id_pemancing)->first())->total_tagihan;
        }

        return view('content.dashboard', $params);
        
    }

}
