<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HadiahJuara;

class HadiahJuaraController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
    }

    public function index(Request $request)
    {

        $params['menu'] = 'hadiah juara'; 
        $params['semuaHadiah'] = HadiahJuara::getAll();
        
        return view('content.hadiah-juara', $params);
    }
    
    public function edit($jumlah_pemancing)
    {

        $params['menu'] = 'edit hadiah juara'; 
        $params['hadiah'] = HadiahJuara::getByJumlahPemancing($jumlah_pemancing);
        
        return view('content.edit-hadiah-juara', $params);
    }
    public function update(Request $request)
    {
        $update1 = HadiahJuara::where('id_hadiah_juara', $request->post('id_juara_1'))->update(
            [
                'hadiah' => $request->post('hadiah_juara_1')
            ]);
        $update2 = HadiahJuara::where('id_hadiah_juara', $request->post('id_juara_2'))->update(
            [
                'hadiah' => $request->post('hadiah_juara_2')
            ]);
        $update3 = HadiahJuara::where('id_hadiah_juara', $request->post('id_juara_3'))->update(
            [
                'hadiah' => $request->post('hadiah_juara_3')
            ]);

        if ($update1 && $update2 && $update3) {
            return redirect(url('/hadiah-juara'));
        }
    }
}
