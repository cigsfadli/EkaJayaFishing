<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekap;
use App\Models\Pemancing;

class LapakMancingController extends Controller
{
    public function index()
    {
        return view('layout.halaman-lapak');
    }
    public function getHalamanLapak()
    {
        $idRekapSekarang = Rekap::max('id_rekap');
        $selectPemancingGanjil = Pemancing::getPemancingGanjil($idRekapSekarang);
        $selectPemancingGenap = Pemancing::getPemancingGenap($idRekapSekarang);
        $lapakGanjil = 1;
        $lapakGenap = 2;
        
        echo "<tr>\n";
        foreach ($selectPemancingGanjil as $pemancing) {

            if ($pemancing['nama_pemancing'] == null) {
                echo "\t<td class='bg-danger'width='10%' style='padding: 15px 10px;color: white;border:1px solid #000; border-width:0px 2px;'>".$lapakGanjil."</td>\n";
            }else {
                echo "\t<td class='bg-success'width='10%' style='padding: 15px 10px;color: white;border:1px solid #000; border-width:0px 2px;'>".$lapakGanjil."</td>\n";
            }
            $lapakGanjil += 2;
        }
        echo "</tr>\n";

        echo "<tr>\n";
        foreach ($selectPemancingGanjil as $pemancing) {

            if ($pemancing['nama_pemancing'] == null) {
                echo "\t<td class='bg-danger' width='10%' style='padding: 15px 10px;color: white;border:1px solid #000; border-width:0px 2px;'>&nbsp;</td>\n";
            }else {
                echo "\t<td class='bg-success' width='10%' style='padding: 15px 10px;color: white;border:1px solid #000; border-width:0px 2px;'>".$pemancing['nama_pemancing']."</td>\n";
            }
        }
        echo "</tr>\n";
        
        
        echo "<tr>\n";
        echo "\t<td style='padding: 1px;'><br><br><br><br><br><br><br><br><br><br><br><br></td>\n";
        echo "</tr>\n";
        
        echo "<tr>\n";
        foreach ($selectPemancingGenap as $pemancing) {
            if ($pemancing['nama_pemancing'] == null) {
                echo "\t<td class='bg-danger' width='10%' style='padding: 15px 10px;color: white;border:1px solid #000; border-width:0px 2px;'>".$lapakGenap."</td>\n";
            }else {
                echo "\t<td class='bg-success' width='10%' style='padding: 15px 10px;color: white;border:1px solid #000; border-width:0px 2px;'>".$lapakGenap."</td>\n";
            }
            $lapakGenap += 2;
        }
        echo "</tr>\n";
        echo "<tr>\n";
        foreach ($selectPemancingGenap as $pemancing) {
            if ($pemancing['nama_pemancing'] == null) {
                echo "\t<td class='bg-danger' width='10%' style='padding: 15px 10px;color: white;border:1px solid #000; border-width:0px 2px;'>&nbsp;</td>\n";
            }else {
                echo "\t<td class='bg-success' width='10%' style='padding: 15px 10px;color: white;border:1px solid #000; border-width:0px 2px;'>".$pemancing['nama_pemancing']."</td>\n";
            }
            
        }
        echo "</tr>\n";
    }
}
