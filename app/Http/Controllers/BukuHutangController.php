<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

use App\Models\BukuHutang;

class BukuHutangController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
        $this->middleware('check.role.admin');
    }

    public function index()
    {

        $params['menu'] = 'buku hutang';
        $params['semuaHutang'] = BukuHutang::all();

        return view('content.buku-hutang', $params);
    }

    public function bayar(Request $request)
    {
        $sisa = ( $request->post("bayar") == null ? 0 : $request->post("bayar")) - $request->post("total");
        if ($sisa < 0) {
            BukuHutang::where('id_kasbon', $request->post("id_kasbon"))->update(["total_kasbon" => $sisa * -1]);
        }else{
            BukuHutang::where('id_kasbon', $request->post("id_kasbon"))->delete();
        }
        return response()->json(["message" => "success"], 200);
    }
    public function bayarDanCetak(Request $request)
    {
        try {


            $icon = EscposImage::load("assets/images/icon/logo-1-black-white.png");
            $connector = new WindowsPrintConnector("58EN");
            $printer = new Printer($connector);
            $printer -> setFont(Printer::FONT_A);

            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> bitImage($icon);
            $printer -> textRaw("\n");







            $nama = sprintf('%4s %6s: %19s',  "Nama", "", strtoupper($request->post("namapemancing")));
            $namaKasir = sprintf('%10s %0s: %19s',  "Nama Kasir", "", strtoupper(session('user')['name']));
            $tanggal = sprintf('%7s %3s: %19s',  "Tanggal", "", date('d/m/Y', time()));
            $kasbon =sprintf('%6s %4s: %19s',  "Hutang", "", $request->post("total"));




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
            $printer -> textRaw("\n");
            $printer -> textRaw($kasbon);
            $printer -> textRaw("\n");

            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> text("-------------------------\n");

            $tunai = sprintf('%5s %6s: %18s',  "Tunai", "", $request->post('bayar'));
            $total = sprintf('%5s %6s: %18s',  "Total", "", $request->post('total'));
            $kembalian = sprintf('%9s %2s: %18s',  "Kembalian", "",  ( $request->post("bayar") == null ? 0 : $request->post("bayar")) - $request->post("total"));


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


            $sisa = ( $request->post("bayar") == null ? 0 : $request->post("bayar")) - $request->post("total");
            if ($sisa < 0) {
                BukuHutang::where('id_kasbon', $request->post("id_kasbon"))->update(["total_kasbon" => $sisa * -1]);
            }else{
                BukuHutang::where('id_kasbon', $request->post("id_kasbon"))->delete();
            }

            return response()->json(['message' => 'Success'], 200);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed'], 200);

        }
    }
}
