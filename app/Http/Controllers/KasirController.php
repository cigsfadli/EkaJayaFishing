<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\Models\Pemancing;
use App\Models\SesiMancing;
use App\Models\TagihanPemancing;
use App\Models\TransaksiTagihan;

class KasirController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
    }
    public function index()
    {
        $params['menu'] = "kasir";
        $params['tagihan'] = TagihanPemancing::getDataTagihan();
        
        return view('content.kasir', $params);
    }
    public function detailTagihan($id_pemancing)
    {
        $params['menu'] = "detail tagihan";
        $params['tagihan'] = TagihanPemancing::getDetailTagihan($id_pemancing);
        
        return view('content.detail-tagihan', $params);
    }




    public function cetakStruk(Request $request, $id_pemancing)
    {
        $select = Pemancing::where('id_pemancing', $id_pemancing)->first();
        $selectBarang = TagihanPemancing::where('id_pemancing', $id_pemancing)->join('barang', 'barang.id_barang', '=', 'tagihan_pemancing.id_barang')->get();
        $selectHadiah = SesiMancing::where('id_pemancing', $id_pemancing)->join('hadiah_juara', 'hadiah_juara.id_hadiah_juara', '=', 'sesi_mancing.id_hadiah')->get();
        $total_hadiah = 0;
        foreach ($selectHadiah as $hadiah) {
            $total_hadiah += $hadiah->hadiah;
        }

try {
    
    
    $icon = EscposImage::load("assets/images/icon/logo-1-black-white.png");
    $connector = new WindowsPrintConnector("58EN");
        $printer = new Printer($connector);
        $printer -> setFont(Printer::FONT_A);
        
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> bitImage($icon);
        $printer -> textRaw("\n");
        

        
        
        
        
        
        $nama = sprintf('%4s %6s: %19s',  "Nama", "", strtoupper($select->nama_pemancing));
        $namaKasir = sprintf('%10s %0s: %19s',  "Nama Kasir", "", strtoupper(session('user')['name']));
        $tanggal = sprintf('%7s %3s: %19s',  "Tanggal", "", date('d/m/Y', time()));
        $sesi = strlen($select->total_sesi) < 2 ? sprintf('%1.0f %1.0sX %1.0f %21.0f',  $select->total_sesi, '',40000, ($select->total_sesi * 40000)) : sprintf('%2.0f X %1.0f %21.0f',  $select->total_sesi, 40000, ($select->total_sesi * 40000)) ;
        $total_tagihan = ($select->total_sesi * 40000);
        



        $printer -> textRaw("\n");
        $printer -> textRaw("KAVLING CIAWITALI\n");
        $printer -> textRaw("\n");
        $printer -> text("-------------------------\n");
        $printer -> textRaw("\n");
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> textRaw($tanggal);
        $printer -> textRaw($nama);
        $printer -> textRaw($namaKasir);
        $printer -> textRaw("\n");
        $printer -> textRaw("\n");
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> textRaw("TAGIHAN\n\n");

        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> textRaw("mancing");
        $printer -> textRaw("\n");
        $printer -> textRaw($sesi);
        $printer -> textRaw("\n");
        foreach ($selectBarang as $barang) {
            $total_tagihan += ($barang->jumlah * $barang->harga_barang);
            $tagihan = strlen($barang->jumlah) < 2 ? sprintf('%1.0f %1.0sX %5.0f %21.0f', $barang->jumlah, '', $barang->harga_barang, ($barang->jumlah * $barang->harga_barang)) : sprintf('%2.0f X %5.0f %21.0f', $barang->jumlah, $barang->harga_barang, ($barang->jumlah * $barang->harga_barang));
            $printer -> textRaw($barang->nama_barang);
            $printer -> textRaw("\n");
            $printer -> textRaw($tagihan);
            $printer -> textRaw("\n");
        }
        $printer -> text("\n");

        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("-------------------------\n");

        $subTotal = sprintf('%9s %2s: %18s',  "Sub Total", "", $total_tagihan);
        $hadiah = sprintf('%6s %5s: %18s',  "Hadiah", "", $total_hadiah != 0 ? '-'.$total_hadiah : 0);
        $ikanGarung = sprintf('%11s %0s: %18s',  "Ikan Garung", "",  $request->post('jumlahikangarung').' X '.  $request->post('hargaikangarung'));
        $totalIkanGarung = sprintf('%32s',  $request->post('ikangarung'));
        $tunai = sprintf('%5s %6s: %18s',  "Tunai", "", $request->post('tunai'));
        $total = sprintf('%5s %6s: %18s',  "Total", "", $request->post('total'));
        $kembalian = sprintf('%9s %2s: %18s',  "Kembalian", "", $request->post('kembalian'));
        
        
        $printer -> textRaw("\n");
        $printer -> textRaw($subTotal);
        $printer -> textRaw("\n");
        $printer -> textRaw($hadiah);
        $printer -> textRaw("\n");
        $printer -> textRaw($ikanGarung);
        $printer -> textRaw("\n");
        $printer -> textRaw($totalIkanGarung);
        $printer -> textRaw("\n");
        $printer -> textRaw("\n");
        $printer -> textRaw($total);
        $printer -> textRaw("\n");
        $printer -> textRaw($tunai);
        $printer -> textRaw("\n");
        $printer -> textRaw($kembalian);
        $printer -> textRaw("\n");
        $printer -> textRaw("\n");


        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("-------------------------\n");
        $printer -> text("Terima Kasih !!\n");
        $printer -> text("\n");
        $printer -> text("\n");
        $printer -> text("\n");
        $printer -> text("\n");
        $printer -> cut();
        $printer -> close();

        TransaksiTagihan::create([
            'id_pemancing' => $id_pemancing,
            'hadiah' => $total_hadiah,
            'ikan_garung' => $request->post('ikangarung'),
            'sub_total' => $total_tagihan,
            'total_tagihan' => $request->post('total'),
            'tunai' => $request->post('tunai'),
            'kembalian' => $request->post('kembalian'),
        ]);
        Pemancing::where('id_pemancing', $id_pemancing)->update(['status_tagihan' => 'sudah bayar']);

        
        return response()->json(['status' => 'Success'], 200);
        
    } catch (\Throwable $th) {
        return response()->json(['status' => 'Failed'], 200);
        
    }



    }
}
