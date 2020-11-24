<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\HadiahJuara;
use Illuminate\Database\Seeder;
use DB;
use Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->insert([
            'name' => 'Eka Jaya',
            'username' => 'ekajaya',
            'email' => 'admin@example.com',
            'password' => Hash::make('kikandrya'),
            'role' => 'admin',
        ]);

        Barang::create([
            'nama_barang' => 'kopi hitam',
            'harga_barang' => 3000
        ]);
        Barang::create([
            'nama_barang' => 'roko magnum',
            'harga_barang' => 2000
        ]);
        Barang::create([
            'nama_barang' => 'kopi good day',
            'harga_barang' => 3000
        ]);

        $hadiah = [
            [null, null, null, null],
            [null, 10000, null, null],
            [null, 20000, null, null],
            [null, 25000, 5000, null],
            [null, 25000, 10000, 5000],
            [null, 30000, 15000, 5000],
            [null, 30000, 20000, 10000],
            [null, 35000, 25000, 10000],
            [null, 40000, 25000, 15000],
            [null, 45000, 30000, 15000],
            [null, 50000, 30000, 20000],
            [null, 55000, 35000, 20000],
            [null, 60000, 35000, 25000],
            [null, 65000, 40000, 25000],
            [null, 70000, 40000, 30000],
            [null, 75000, 45000, 30000],
            [null, 80000, 45000, 35000],
            [null, 85000, 50000, 35000],
            [null, 90000, 50000, 40000],
            [null, 95000, 55000, 40000],
            [null, 10000, 55000, 45000],
        ];
        $data = [];
        for ($i=1; $i <= 20; $i++) { 
            for ($a=1; $a <= 3; $a++) { 
                $juara = [
                    'jumlah_pemancing' => $i,
                    'juara_ke' => $a,
                    'hadiah' => $hadiah[$i][$a]
                ];
                array_push($data, $juara);
            }
        }
        DB::table('hadiah_juara')->insert(@$data);
    }
}
