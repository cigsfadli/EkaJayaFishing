<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempHitungIkan extends Model
{
    use HasFactory;
    protected $table = "temp_hitung_ikan";
    protected $fillable = [
        'id_pemancing',
        'id_rekap',
        'id_hadiah',
        'sesi_ke',
        'lapak',
        'jumlah_ikan',
    ];
}
