<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekap;
use App\Models\Pemancing;
use App\Models\SesiMancing;
use App\Models\HadiahJuara;
use App\Models\TempHitungIkan;
use DB;

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
                        if($pemancing->ganjil_genap != null){
                            echo "\t\t<small><a class='btn btn-success text-light' name='$url' title='Selesai' onclick='return konfirmasi(this.name)'><i class='fa fa-flag fa-sm'></i></a></small>\n";
                        }
                    }
                    if ($pemancing->lapak_sekarang == null && $pemancing->ganjil_genap == null) {
                        echo "\t\t
                        <small>
                            <a href='". url('/rekap-mancing/delete-pemancing').'/'.$pemancing->id_pemancing."' class='btn btn-danger text-light' title='Hapus' onclick='return confirm('Hapus Pemancing ?')'>
                                <i class='fa fa-trash fa-sm'></i>
                            </a>
                        </small>\n";
                    }
                    if ($pemancing->status_tagihan == 'belum bayar') {
                        echo "\t\t<small><a class='btn btn-warning text-light btnTagihan' onclick='openModalTambahTagihan(this.name)' name='".$pemancing->id_pemancing."' title='Tambah Tagihan'  data-toggle='modal' data-target='#exampleModalCenter2'><i class='fa fa-money-bill-alt fa-sm'></i></a></small>\n";
                    }
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
            $jumlahIkanSebelumnya = 0;

            $hasilSesiSebelumnya =
                SesiMancing::where("id_pemancing",  $idpemancing[$i])->get();

            foreach ($hasilSesiSebelumnya as $sesi_mancing) {

                $jumlahIkanSebelumnya += $sesi_mancing->jumlah_ikan;

            }

            SesiMancing::create([
                'id_pemancing' => $idpemancing[$i],
                'id_rekap' => $request->post('idrekap'),
                'sesi_ke' => $sesi,
                'lapak' => $lapaksekarang[$i],
                'jumlah_ikan' => ( $jumlahikan[$i] - $jumlahIkanSebelumnya),
            ]);

            $totalSesi = (Pemancing::where('id_pemancing', $idpemancing[$i])->first()->total_sesi);
            Pemancing::where('id_pemancing', $idpemancing[$i])->update([
                'total_sesi' => $totalSesi + 1
            ]);
        }


        $params['menu'] = "hitung hadiah";

        $params['id_rekap'] = $request->post('idrekap');

        $select =
            SesiMancing::where('sesi_ke', $sesi)
                ->where('sesi_mancing.id_rekap', $request->post('idrekap'))
                ->join("pemancing", "pemancing.id_pemancing", "=", "sesi_mancing.id_pemancing")
                ->orderBy('jumlah_ikan', 'DESC')
                ->limit(6)
                ->select([
                    'sesi_mancing.id_pemancing',
                    'sesi_mancing.id_rekap',
                    'sesi_mancing.hadiah',
                    'sesi_mancing.sesi_ke',
                    'sesi_mancing.lapak',
                    'sesi_mancing.jumlah_ikan',
                ]);

        $bindings = $select->getBindings();

        $insertQuery ="INSERT into temp_hitung_ikan (id_pemancing, id_rekap, hadiah, sesi_ke, lapak, jumlah_ikan)"
                . $select->toSql();

        DB::insert($insertQuery, $bindings);

        $urlRedirect = "/rekap-mancing/". $request->post('idrekap') ."/detail-rekap";
        return redirect(url($urlRedirect));

    }
    public function deletePemancing($id_pemancing)
    {
        $delete = Pemancing::where('id_pemancing', $id_pemancing)->delete();
        if($delete){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function hitungHadiah($idRekap)
    {
        $params["menu"] = "hitung hadiah";
        $params["sesi"] = DB::table("temp_hitung_ikan")->select(["sesi_ke"])->where("id_rekap", $idRekap)->distinct()->get();
        $params["idRekap"] = $idRekap;

        return view('content.hitung-hadiah', $params);
    }
    public function getJuara($id_rekap, $sesi)
    {
        $params["sesi"] = $sesi;
        $params["idRekap"] = $id_rekap;
        $params['jumlahPemancing']  = DB::table("temp_hitung_ikan")->where("id_rekap", $id_rekap)->where("sesi_ke", $sesi)->count();
        $params["dataSesiMancing"] = DB::table("temp_hitung_ikan")
                                        ->where("temp_hitung_ikan.id_rekap", $id_rekap)
                                        ->where("temp_hitung_ikan.sesi_ke", $sesi)
                                        ->join("pemancing", "temp_hitung_ikan.id_pemancing", "=", "pemancing.id_pemancing")
                                        ->limit(6)
                                        ->orderBy("jumlah_ikan", "DESC")
                                        ->get();

        return view('content.view-tambahan.form-hitung-hadiah', $params);
    }

    public function simpanHitungHadiah(Request $request)
    {
        for ($i=0; $i < count($request->post('id_temp_hitung_ikan')); $i++) {

            SesiMancing::where('id_pemancing', $request->post('id_pemancing')[$i])
            ->where('sesi_ke', $request->post('sesi_ke'))
            ->update([
                "hadiah" =>  $request->post('hadiah')[$i] == null ? 0 : $request->post('hadiah')[$i]
            ]);

            DB::table("temp_hitung_ikan")
            ->where('id_pemancing', $request->post('id_pemancing')[$i])
            ->where('sesi_ke', $request->post('sesi_ke'))
            ->delete();

        };
        $url = "/rekap-mancing/" . $request->post('idRekap') . "/detail-rekap";
        return redirect($url);
    }



















    public function checkLapakRandom($id_rekap, $id_pemancing)
    {
        $ganjil_count = Pemancing::where('id_rekap', $id_rekap)->where('ganjil_genap', 'ganjil')->count();
        $genap_count = Pemancing::where('id_rekap', $id_rekap)->where('ganjil_genap', 'genap')->count();

        if ($ganjil_count > $genap_count) {
            $this->checkLapakGenap($id_rekap, $id_pemancing);
        }elseif ($ganjil_count < $genap_count) {
            $this->checkLapakGanjil($id_rekap, $id_pemancing);
        }else{
            $jumlahPemancing = (Pemancing::where('id_rekap', $id_rekap)->count()) % 2 == 0 ? Pemancing::where('id_rekap', $id_rekap)->count() : (Pemancing::where('id_rekap', $id_rekap)->count() + 1);
            $random = rand(1, $jumlahPemancing);
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
    }


    public function checkLapakGanjil($id_rekap, $id_pemancing)
    {

        $jumlahPemancing = (Pemancing::where('id_rekap', $id_rekap)->count()) % 2 == 0 ? Pemancing::where('id_rekap', $id_rekap)->count() : (Pemancing::where('id_rekap', $id_rekap)->count() + 1);
        $random = rand(1, $jumlahPemancing);
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
        $jumlahPemancing = (Pemancing::where('id_rekap', $id_rekap)->count()) % 2 == 0 ? Pemancing::where('id_rekap', $id_rekap)->count() : (Pemancing::where('id_rekap', $id_rekap)->count() + 1);
        $random = rand(1, $jumlahPemancing);
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
