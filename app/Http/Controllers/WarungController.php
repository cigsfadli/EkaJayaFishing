<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Barang;

class WarungController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
        $this->middleware('check.role.admin');
    }

    public function index(Request $request)
    {
        $params['barangs'] = Barang::where('delete', 0)->get();

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

    public function edit($id_barang)
    {
        $params['menu'] = 'edit barang';
        $params['barang'] = Barang::where('id_barang', $id_barang)->first();
        
        return view('content.edit-barang', $params);
    }

    public function update(Request $request)
    {
        $update = Barang::where('id_barang', $request->post('id_barang'))->update([
            'nama_barang' => $request->post('nama_barang'),
            'harga_barang' => $request->post('harga_barang'),
        ]);

        if ($update) {
            return redirect(url('/warung'));
        }
    }
    public function destroy($id_barang)
    {
        $delete = Barang::where('id_barang', $id_barang)->update(['delete' => 1]);
        if($delete){
            return redirect()->back();
        }
    }

    public function getOption()
    {
        $barangs = Barang::all();
        echo "<option value=''>Pilih Barang</option>";
        foreach ($barangs as $barang) {
            echo "<option value='".$barang->id_barang."'>";
            echo $barang->nama_barang;
            echo "</option>";
        }
    }
}
