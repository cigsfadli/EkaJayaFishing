<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTagihan extends Model
{
    use HasFactory;
    protected $table = "transaksi_tagihan";
    protected $fillable = [
        'id_pemancing',
        'hadiah',
        'ikan_garung',
        'sub_total',
        'total_tagihan',
        'tunai',
        'kembalian',
    ];
}
