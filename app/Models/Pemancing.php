<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Pemancing extends Model
{
    use HasFactory;
    protected $table = 'pemancing';
    protected $fillable = [
        'id_rekap',
        'nama_pemancing',
        'status',
        'lapak_sekarang',
        'total_sesi',

    ];

    public function scopeGetPemancingGanjil($query, $idRekap)
    {
        $return = new Collection();
        for ($i=1; $i <= 20; $i++) { 
            if ($i % 2 != 0) {
                $selectPemancing = ($this->where('id_rekap', $idRekap)->where('ganjil_genap', 'ganjil')->where('status', 'masih mancing')->where('lapak_sekarang', $i)->first()); 
                $return->add([
                    'nama_pemancing' => ($selectPemancing == null) ? '' : $selectPemancing->nama_pemancing ,
                ]);
            }
        }
        return $return;
        
    }
    public function scopeGetPemancingGenap($query, $idRekap)
    {
        $return = new Collection();
        for ($i=1; $i <= 20; $i++) { 
            if ($i % 2 == 0) {
                $selectPemancing = ($this->where('id_rekap', $idRekap)->where('ganjil_genap', 'genap')->where('status', 'masih mancing')->where('lapak_sekarang', $i)->first()); 
                $return->add([
                    'nama_pemancing' => ($selectPemancing == null) ? '' : $selectPemancing->nama_pemancing ,
                ]);
            }
        }
        return $return;
        
    }
}
