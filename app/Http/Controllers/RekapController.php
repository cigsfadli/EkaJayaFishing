<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekap;
use App\Models\Pemancing;
use App\Models\SesiMancing;
use App\Models\HadiahJuara;

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
    public function detailRekap($id_rekap)
    {
        
        $params['menu'] = 'detail rekap';
        $params['rekap'] = Rekap::getDataRekapById($id_rekap);
        if ($params['rekap'] == 0) {
            return redirect(url('rekap-mancing'));
        }
        return view('content.detail-rekap-mancing', $params);
    }

    public function tambahPemancing(Request $request)
    {
        $jmlPemancing = Pemancing::where('id_rekap', $request->post('idrekap'))->where('status', 'masih mancing')->count();
        if ($jmlPemancing < 20) {
            
            $create = Pemancing::create([
                'id_rekap' => $request->post('idrekap'),
                'nama_pemancing' => $request->post('namapemancing')
            ]);

            return response()->json(['status' => 'Success'], 200);
        }else{
            return response()->json(['status' => 'failed', 'message' => 'Lapak Penuh!'], 200);
        }

    }

    public function pemancing($id_rekap)
    {
        $pemancings = Pemancing::where('id_rekap', $id_rekap)->get();
        
        $nomor = 1;
        foreach ($pemancings as $pemancing) {
            $url = url('/rekap-mancing/selesai-mancing')."/".$pemancing->id_pemancing;
            echo "<tr>\n";
                echo "\t<td class='align-middle text-center'>$nomor</td>\n";
                echo "\t<td class='align-middle'>$pemancing->nama_pemancing</td>\n";

                if ($pemancing->status == "selesai") {
                    echo "\t<td  class='text-success align-middle text-center' title='Selesai Mancing'><i class='fa fa-check'></i>&nbsp;selesai</td>\n";
                }else{
                    echo "\t<td class='text-center align-middle'>$pemancing->lapak_sekarang</td>\n";
                }
                echo "\t<td>\n";
                    if ($pemancing->status != "selesai") {
                        echo "\t\t<small><a class='btn btn-success text-light' name='$url' title='Selesai' onclick='return konfirmasi(this.name)'><i class='fa fa-flag fa-sm'></i></a></small>\n";
                    }
                    if ($pemancing->lapak_sekarang == null && $pemancing->ganjil_genap == null) {
                        echo "\t\t<small><a class='btn btn-danger text-light' title='Hapus'><i class='fa fa-trash fa-sm'></i></a></small>\n";
                    }
                echo "\t\t<small><a class='btn btn-warning text-light btnTagihan' onclick='openModalTambahTagihan(this.name)' name='".$pemancing->id_pemancing."' title='Tambah Tagihan'  data-toggle='modal' data-target='#exampleModalCenter2'><i class='fa fa-money-bill-alt fa-sm'></i></a></small>\n";
                echo "\t</td>\n";
            echo "</tr>\n";
            $nomor++;
        }
    }
    public function jumlahPemancing($id_rekap)
    {
        echo Pemancing::where('id_rekap', $id_rekap)->count();
    }
    public function kocokLapak($id_rekap)
    {
        $pemancings = Pemancing::where('id_rekap', $id_rekap)->where('status', 'masih mancing')->get();
        Pemancing::where('id_rekap', $id_rekap)->update(["lapak_sekarang" => null]);
        // dd($pemancings);
        foreach ($pemancings as $pemancing) {
            if ($pemancing->ganjil_genap == 'ganjil') {
                $this->checkLapakGenap($id_rekap, $pemancing->id_pemancing);
            }elseif ($pemancing->ganjil_genap == 'genap') {
                $this->checkLapakGanjil($id_rekap, $pemancing->id_pemancing);
            }else{
                $this->checkLapakRandom($id_rekap, $pemancing->id_pemancing);
            }

        }

        return response()->json(['status' => 'Success'], 200);
    }

    public function selesaiMancing($id_pemancing)
    {
        $selesai = Pemancing::where('id_pemancing', $id_pemancing)->update([
            'status' => 'selesai',
            'lapak_sekarang' => null
        ]);

        if ($selesai) {
            return response()->json(['status' => 'Success'], 200);
        }else{
            return response()->json(['status' => 'Failed'], 200);
        }
    
    }


    public function hitungIkan($id_rekap)
    {
        $params['menu'] = "hitung ikan";
        $params['id_rekap'] = $id_rekap;
        $params['semuaPemancing'] = Pemancing::where('id_rekap', $id_rekap)->whereNotNull('lapak_sekarang')->get();
        return view('content.hitung-ikan', $params);
    }
    public function simpanHitungIkan(Request $request, $id_rekap)
    {
        
        $idpemancing = $request->post('idpemancing');
        $lapaksekarang = $request->post('lapaksekarang');
        $jumlahikan = $request->post('jumlahikan');
        $jumlahPemancing = count($idpemancing);

        $sesi = SesiMancing::where('id_rekap', $request->post('idrekap'))->max('sesi_ke') + 1;
        
        for ($i=0; $i < count($request->post('idpemancing')); $i++) { 
            SesiMancing::create([
                'id_pemancing' => $idpemancing[$i],
                'id_rekap' => $request->post('idrekap'),
                'sesi_ke' => $sesi,
                'lapak' => $lapaksekarang[$i],
                'jumlah_ikan' => $jumlahikan[$i],
            ]);
            $totalSesi = (Pemancing::where('id_pemancing', $idpemancing[$i])->first()->total_sesi);
            Pemancing::where('id_pemancing', $idpemancing[$i])->update([
                'total_sesi' => $totalSesi + 1
            ]);
        }

        $select = SesiMancing::where('sesi_ke', $sesi)->where('id_rekap', $request->post('idrekap'))->orderBy('jumlah_ikan', 'DESC')->limit(3)->get();
        $a = 1;
        foreach ($select as $mancing) {
            SesiMancing::where('id_sesi_mancing', $mancing->id_sesi_mancing)->update([
                "id_hadiah" => (HadiahJuara::where('jumlah_pemancing', $jumlahPemancing)->where('juara_ke', $a++)->first())->id_hadiah_juara
            ]);
        }
        
        return redirect('rekap-mancing/'.$request->post('idrekap').'/detail-rekap');
    }




















    public function checkLapakRandom($id_rekap, $id_pemancing)
    {
        $random = rand(1, 20);
        if ((Pemancing::where('id_rekap', $id_rekap)->where('lapak_sekarang', $random)->count()) < 1) {
            if ($random % 2 == 0) {
                Pemancing::where('id_pemancing', $id_pemancing)->update([
                    'lapak_sekarang' => $random,
                    'ganjil_genap' => "genap",
                ]);
            }else{
                Pemancing::where('id_pemancing', $id_pemancing)->update([
                    'lapak_sekarang' => $random,
                    'ganjil_genap' => "ganjil",
                ]);
            }
            
        }else{
            $this->checkLapakRandom($id_rekap, $id_pemancing);
        }
    }


    public function checkLapakGanjil($id_rekap, $id_pemancing)
    {
        
        $random = rand(1, 20);
        if ((Pemancing::where('id_rekap', $id_rekap)->where('lapak_sekarang', $random)->count()) < 1 && $random % 2 != 0) {
            Pemancing::where('id_pemancing', $id_pemancing)->update([
                'lapak_sekarang' => $random,
                'ganjil_genap' => "ganjil",
            ]);
            
        }else{
            $this->checkLapakGanjil($id_rekap, $id_pemancing);
        }
    }


    public function checkLapakGenap($id_rekap, $id_pemancing)
    {
        $random = rand(1, 20);
        if ((Pemancing::where('id_rekap', $id_rekap)->where('lapak_sekarang', $random)->count()) < 1 && $random % 2 == 0) {
            Pemancing::where('id_pemancing', $id_pemancing)->update([
                'lapak_sekarang' => $random,
                'ganjil_genap' => "genap",
            ]);
            
        }else{
            $this->checkLapakGenap($id_rekap, $id_pemancing);
        }
    }

}
