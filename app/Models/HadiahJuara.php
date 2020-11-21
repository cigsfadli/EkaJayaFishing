<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class HadiahJuara extends Model
{
    use HasFactory;
    protected $table = 'hadiah_juara';
    protected $fillable = [
        'jumlah_pemancing',
        'juara_ke',
        'hadiah',
    ];
    protected $primaryKey = 'id_hadiah_juara';

    public function scopeGetAll($query)
    {
        $return = new Collection();
        $semuaJuara = $this->select('jumlah_pemancing')->distinct()->get();
        foreach ($semuaJuara as $juara) {
            $return->add([
                'jumlah_pemancing' => $juara->jumlah_pemancing,
                'juara_1' => ($this->select('hadiah')->where('jumlah_pemancing', $juara->jumlah_pemancing)->where('juara_ke', 1)->first())->hadiah,
                'juara_2' => ($this->select('hadiah')->where('jumlah_pemancing', $juara->jumlah_pemancing)->where('juara_ke', 2)->first())->hadiah,
                'juara_3' => ($this->select('hadiah')->where('jumlah_pemancing', $juara->jumlah_pemancing)->where('juara_ke', 3)->first())->hadiah,
            ]);
        }
        return $return;
    }

    public function scopeGetByJumlahPemancing($query, $jumlah_pemancing)
    {
        $return = [];
        $data = $this->where('jumlah_pemancing', $jumlah_pemancing)->get();
        foreach ($data as $hadiah) {
            $return = [
                'jumlah_pemancing' => $jumlah_pemancing,
                'id_juara_1' => ($this->select('id_hadiah_juara')->where('jumlah_pemancing', $jumlah_pemancing)->where('juara_ke', 1)->first())->id_hadiah_juara,
                'id_juara_2' => ($this->select('id_hadiah_juara')->where('jumlah_pemancing', $jumlah_pemancing)->where('juara_ke', 2)->first())->id_hadiah_juara,
                'id_juara_3' => ($this->select('id_hadiah_juara')->where('jumlah_pemancing', $jumlah_pemancing)->where('juara_ke', 3)->first())->id_hadiah_juara,
                'juara_1' => ($this->select('hadiah')->where('jumlah_pemancing', $jumlah_pemancing)->where('juara_ke', 1)->first())->hadiah,
                'juara_2' => ($this->select('hadiah')->where('jumlah_pemancing', $jumlah_pemancing)->where('juara_ke', 2)->first())->hadiah,
                'juara_3' => ($this->select('hadiah')->where('jumlah_pemancing', $jumlah_pemancing)->where('juara_ke', 3)->first())->hadiah,];
        }
        return $return;
    }
}
