<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagihanPemancing;

class TagihanPemancingController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
    }

    public function add(Request $request)
    {
        $select = TagihanPemancing::where('id_pemancing', $request->post('idpemancing'))->where('id_barang', $request->post('idbarang'));
        $data = $select->first();
        if ($select->count() > 0) {
            $jumlah = $data->jumlah;
            $update = TagihanPemancing::where('id_pemancing', $request->post('idpemancing'))->where('id_barang', $request->post('idbarang'))->update(['jumlah'=> ( $jumlah + $request->post('jumlah'))]);
            if ($update) {
                return response()->json(['status' => "Success"], 200);
            }
        }else{
            $create = TagihanPemancing::create([
                'id_pemancing' => $request->post('idpemancing'),
                'id_barang' => $request->post('idbarang'),
                'jumlah' => $request->post('jumlah'),
                ]);
            if ($create) {
                return response()->json(['status' => "Success"], 200);
            }
        }
        return response()->json(['status' => "Success"], 200);
        

    }
}
