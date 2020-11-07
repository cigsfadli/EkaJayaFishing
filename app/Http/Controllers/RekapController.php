<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekap;

class RekapController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
    }

    public function index()
    {    
        $params['menu'] = 'rekap mancing'; 
        $params['no'] = 1;
        $params['rekaps'] = Rekap::getDataRekap();

        return view('content.rekap-mancing', $params);
            
    }
    public function create()
    {
        $date = date(\Carbon\Carbon::now());
        $keyword = date('Y-m-d', strtotime($date));

        if(Rekap::where('tanggal_rekap', 'LIKE', $keyword.'%')->count() < 1){
            
            $create = Rekap::create(['tanggal_rekap' => \Carbon\Carbon::now()]);
            
            if ($create) {
                return redirect()->back();
            }

        }else {
            return redirect()->back()->withErrors(['err' => 'rekap hari ini  sudah dibuat ! ']);
        }

    }
}
