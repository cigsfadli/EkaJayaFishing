<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiMancing extends Model
{
    use HasFactory;
    protected $table = "sesi_mancing";
    protected $fillable = [
        'id_pemancing',
        'id_rekap',
        'id_hadiah',
        'sesi_ke',
        'lapak',
        'jumlah_ikan',
    ];
}

