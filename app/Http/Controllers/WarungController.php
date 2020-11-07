<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Barang;

class WarungController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
    }

    public function index(Request $request)
    {
        $params['barangs'] = Barang::all();

        $params['menu'] = 'warung'; 
        return view('content.warung', $params);
        
    }

    public function add()
    {
        $params['barangs'] = Barang::all();

        $params['menu'] = 'tambah barang'; 
        return view('content.tambah-barang', $params);
    }

    public function create(Request $request)
    {
        $create = Barang::create([
            'nama_barang' => $request->post('nama_barang'),
            'harga_barang' => $request->post('harga_barang')
        ]);

        if($create){
            return redirect(url('warung'));
        }
    }
}
