<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemancing;
use App\Models\Rekap;
use App\Models\TransaksiTagihan;


use PDF;



class LaporanController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
        $this->middleware('check.role.admin');
    }
    public function index()
    {
        $params["menu"] = "laporan";
        return view('content.laporan', $params);
    }
    public function searchData(Request $request)
    {
        $startdate = date('Y-m-d H:i:s',strtotime($request->post("startdate")));
        $enddate = date('Y-m-d H:i:s',strtotime($request->post("enddate")) + 86399);
        $rekap = Rekap::whereBetween('created_at', [$startdate , $enddate])->get();
        $pendapatan = 0;
        $no = 1;
        foreach ($rekap as $data) {
            $tagihan = 0;
            $pemancings = Pemancing::where('id_rekap', $data->id_rekap)->where('status_tagihan', 'sudah bayar')->get();
            $tanggal = $this->checkTanggal($data->tanggal_rekap);
            foreach ($pemancings as $pemancing) {
                $tagihan += (TransaksiTagihan::where('id_pemancing', $pemancing->id_pemancing)->first())->total_tagihan;
            }
            $pendapatan += $tagihan;
            echo "<tr>";
                echo "<td class='text-center'>";
                    echo $no++;
                echo "</td>";
                echo "<td>";
                    echo $tanggal;
                echo "</td>";
                echo "<td class='text-center'>";
                    echo Pemancing::where('id_rekap', $data->id_rekap)->count();
                echo "</td>";
                echo "<td>RP ";
                    echo $tagihan;
                echo "</td>";

            echo "</tr>";
        }
        echo "<tr>";
            echo "<td colspan='3'>Total Pendapatan</td>";
            echo "<td colspan='3'>RP ".$pendapatan."</td>";
        echo "</tr>";
    }
    public function checkTanggal($date)
    {
        $return = "";
        $hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
        $bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $return = $hari[date('w', strtotime($date))].', '.date('d', strtotime($date)).' '.$bulan[(date('m', strtotime($date)) < 10 ? substr(date('m', strtotime($date)), 1) : date('m', strtotime($date)))].' '.date('Y', strtotime($date));
        return $return;
    }




    public function printReport(Request $request)
    {
        $startdate = date('Y-m-d H:i:s',strtotime($request->get("startdate")));
        $enddate = date('Y-m-d H:i:s',strtotime($request->get("enddate")) + 86399);
        $rekap = Rekap::whereBetween('created_at', [$startdate , $enddate])->get();
        $params['data'] = [
            'startdate' => $this->checkTanggal($startdate),
            'enddate' => $this->checkTanggal($enddate),
        ];
        $params['dataRekap'] = [];
        $params['totalPendapatan'] = 0;


        foreach ($rekap as $data) {
            $tagihan = 0;
            $pemancings = Pemancing::where('id_rekap', $data->id_rekap)->where('status_tagihan', 'sudah bayar')->get();
            $tanggal = $this->checkTanggal($data->tanggal_rekap);
            foreach ($pemancings as $pemancing) {
                $tagihan += (TransaksiTagihan::where('id_pemancing', $pemancing->id_pemancing)->first())->total_tagihan;
            }
            $data = [
                "tanggal" => $tanggal,
                "jumlah_pemancing" => Pemancing::where('id_rekap', $data->id_rekap)->count(),
                "jumlah_pendapatan" => $tagihan,
            ];
            array_push( $params['dataRekap'], $data);

            $params['totalPendapatan'] += $tagihan;
        }

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadview('layout.report', $params);

        return $pdf->stream();
    }
}
