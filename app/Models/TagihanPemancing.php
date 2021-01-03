<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\Pemancing;
use App\Models\SesiMancing;

class TagihanPemancing extends Model
{
    use HasFactory;
    protected $table = 'tagihan_pemancing';
    protected $fillable = [
        'id_pemancing',
        'id_barang',
        'jumlah',
        'status',
    ];

    public function scopeGetDataTagihan()
    {
        $return = new Collection();
        $data = Pemancing::where('status', 'selesai')->where('status_tagihan', 'belum bayar')->get();
        foreach ($data as $pemancing) {
            $totalTagihan = 0;
            $dataTagihan = $this->where('id_pemancing', $pemancing->id_pemancing)->join('barang', 'tagihan_pemancing.id_barang', '=', 'barang.id_barang')->get();
            foreach ($dataTagihan as $tagihan) {
                $totalTagihan += ($tagihan->harga_barang * $tagihan->jumlah);
            }
            $totalTagihan += ($pemancing->total_sesi * 40000);
            $return->add([
                'id_pemancing' => $pemancing->id_pemancing,
                'nama_pemancing' => $pemancing->nama_pemancing,
                'tagihan' => $totalTagihan,
            ]);
        }


        return $return;
    }

    public function scopeGetDetailTagihan($query, $id_pemancing)
    {
        $semuaTagihan = [];

        $return = new Collection();

        $pemancing = Pemancing::where('id_pemancing', $id_pemancing)->first();
        $dataTagihan = $this->where('id_pemancing', $pemancing->id_pemancing)->join('barang', 'tagihan_pemancing.id_barang', '=', 'barang.id_barang')->get();

        $sub_total = $pemancing->total_sesi * 40000;
        $selectHadiah = SesiMancing::where('id_pemancing', $id_pemancing)->get();

        $total_hadiah = 0;
        foreach ($selectHadiah as $hadiah) {
            $total_hadiah += $hadiah->hadiah;
        }



        foreach ($dataTagihan as $tagihan) {
            $sub_total += ($tagihan->harga_barang * $tagihan->jumlah);
            array_push($semuaTagihan, [
                'namaBarang' => $tagihan->nama_barang,
                'jumlah' => $tagihan->jumlah,
                'harga' => $tagihan->harga_barang,
                'subTotal' => ($tagihan->harga_barang * $tagihan->jumlah)
            ]);
        }


        $return->add([
            'id_pemancing' => $pemancing->id_pemancing,
            'nama_pemancing' => $pemancing->nama_pemancing,
            'tanggal' => date('d / m / Y', time()),
            'mancing' => [
                'jumlah' => $pemancing->total_sesi,
                'harga' => 40000,
                'subTotal' => ($pemancing->total_sesi * 40000)
            ],
            'tagihan' => $semuaTagihan,
            'sub_total' => $sub_total,
            'hadiah' => $total_hadiah
        ]);


        return $return->first();
    }
}
