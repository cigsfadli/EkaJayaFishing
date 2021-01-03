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
        $params['sudahDibayar'] = Pemancing::where('status_tagihan', 'sudah bayar')->get()->count();
        $params['belumDibayar'] = Pemancing::where('status_tagihan', 'belum bayar')->get()->count();
        $params['labelTujuhHariTerakhir'] = [];
        $params['pendapatanTujuhHariTerakhir'] = [];
        $params['pemancingTujuhHariTerakhir'] = [];

        $rekaps =  Rekap::orderBy('id_rekap', 'DESC')->limit(7)->get()->toarray();

        // foreach ($rekaps as $rekap) {
        //     $data = $this->checkTanggal($rekap->created_at);
        //     array_push($params['labelTujuhHariTerakhir'], $data);
        // }
        for ($i = (count($rekaps)-1); $i >= 0; $i--) { 
            $data['label'] = $this->checkTanggal($rekaps[$i]['created_at']);
            $data['pendapatan'] = 0;
            $data['pemancing'] = Pemancing::where('id_rekap', $rekaps[$i]['id_rekap'])->count();
            $pemancings = Pemancing::where('id_rekap',$rekaps[$i]['id_rekap'])->where('status_tagihan', 'sudah bayar')->get();

            foreach ($pemancings as $pemancing) {
                $data['pendapatan'] += (TransaksiTagihan::where('id_pemancing', $pemancing->id_pemancing)->first())->total_tagihan;
            }

            array_push($params['labelTujuhHariTerakhir'], $data['label']);
            array_push($params['pendapatanTujuhHariTerakhir'], $data['pendapatan']);
            array_push($params['pemancingTujuhHariTerakhir'], $data['pemancing']);
        }
        if (count($rekaps) < 7) {
            for ($i=0; $i < (7 - count($rekaps)) ; $i++) { 
                array_push($params['labelTujuhHariTerakhir'], "");
                array_push($params['pendapatanTujuhHariTerakhir'], "");
                array_push($params['pemancingTujuhHariTerakhir'], "");
            }
        }
        


        foreach ( Pemancing::all() as $pemancing) {
            $transaksiTagihan = TransaksiTagihan::where('id_pemancing', $pemancing->id_pemancing)->first();
            $params['pendapatan'] += ($transaksiTagihan != null ? $transaksiTagihan->total_tagihan : 0);
        }
        // dump($params['labelTujuhHariTerakhir']);
        // dump($params['pendapatanTujuhHariTerakhir']);

        return view('content.dashboard', $params);
        
    }
    
    public function checkTanggal($date)
    {
        $return = "";
        $hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
        $return = $hari[date('w', strtotime($date))];
        return $return;
    }

}
