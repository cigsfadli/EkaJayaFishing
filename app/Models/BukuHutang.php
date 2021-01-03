<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuHutang extends Model
{
    use HasFactory;
    protected $table = "catatan_kasbon";
    protected $fillable = [
        "nama_pemancing",
        "total_kasbon"
    ];
}
