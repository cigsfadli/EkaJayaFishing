<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\Pemancing;

class Rekap extends Model
{
    use HasFactory;
    protected $table = "rekap";
    protected $fillable = [
        'tanggal_rekap'
    ];
    protected $primaryKey = "id_rekap";


    public function scopeGetDataRekap($query)
    {
        $data = $this->orderBy('id_rekap', 'DESC')->get();
        $res = new Collection();
        foreach($data as $rekap){
            
            $res->add([
                'id_rekap' => $rekap->id_rekap,
                'tanggal_rekap' => $this->checkHari($rekap->tanggal_rekap).date(', d - m - Y', strtotime($rekap->tanggal_rekap)),
                'jumlah_pemancing' => Pemancing::where('id_rekap', $rekap->id_rekap)->count(),
            ]);
            
        }
        return $res;
    }
    public function scopeGetDataRekapById($query, $id_rekap)
    {
        $rekap = $this->where('id_rekap', $id_rekap)->first();
        if ($rekap == null) {
            return 0;
        }
        $res = [];
        $res['hari'] = $this->checkHari($rekap->tanggal_rekap);
        $res['tanggal'] = date('d / m / Y', strtotime($rekap->tanggal_rekap));
        $res['jumlah_pemancing'] = Pemancing::where('id_rekap', $rekap->id_rekap)->count();
        $res['id_rekap'] = $rekap->id_rekap;
        return $res;
    }


    public function checkHari($date)
    {
        $hari = '';
        switch(date('D', strtotime($date))){
            case 'Mon': 
                $hari = 'Senin';
                break;
            case 'Tue': 
                $hari = 'Selasa';
                break;
            case 'Wed': 
                $hari = 'Rabu';
                break;
            case 'Thu': 
                $hari = 'Kamis';
                break;
            case 'Fri': 
                $hari = 'Jum`at';
                break;
            case 'Sat': 
                $hari = 'Sabtu';
                break;
            case 'Sun': 
                $hari = 'Minggu';
                break;
        }
        return $hari;
    }
    
}
