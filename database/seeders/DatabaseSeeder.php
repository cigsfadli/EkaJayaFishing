<?php

namespace Database\Seeders;

use App\Models\Barang;
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
            'name' => 'iwan setiawan',
            'username' => 'iwansetiawan',
            'email' => 'iwansetiawan@ekajayafishing.com',
            'password' => Hash::make('kasir'),
            'role' => 'super admin',
        ]);

        Barang::create([
            'nama_barang' => 'kopi hitam',
            'harga_barang' => 3000
        ]);
    }
}
