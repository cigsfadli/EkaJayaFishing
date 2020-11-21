<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['App\Http\Controllers\DashboardController', 'index'])->name('dashboard.home');

Route::group(['prefix' => 'auth'], function () {
    Route::get('/signin', ['App\Http\Controllers\Auth\SignInController','index']);
    Route::post('/signin', ['App\Http\Controllers\Auth\SignInController','signIn']);
    Route::get('/signout', ['App\Http\Controllers\Auth\SignOutController','signOut']);
});

Route::group(['prefix' => 'warung'], function () {
    Route::get('/', ['App\Http\Controllers\WarungController', 'index'])->name('warung.home');
    Route::get('/tambah-barang', ['App\Http\Controllers\WarungController', 'add'])->name('warung.add');
    Route::post('/tambah-barang', ['App\Http\Controllers\WarungController', 'create'])->name('warung.create');
    Route::get('/barang-option', ['App\Http\Controllers\WarungController', 'getOption']);
});

Route::group(['prefix' => 'rekap-mancing'], function () {
    Route::get('/', ['App\Http\Controllers\RekapController', 'index'])->name('rekap.home');
    Route::get('/tambah-rekap', ['App\Http\Controllers\RekapController', 'create'])->name('rekap.create');
    Route::get('/{id_rekap}/detail-rekap', ['App\Http\Controllers\RekapController', 'detailRekap'])->name('rekap.detail');
    Route::get('/{id_rekap}/detail-rekap/hitung-ikan', ['App\Http\Controllers\RekapController', 'hitungIkan'])->name('rekap.hitung-ikan');
    Route::post('/{id_rekap}/detail-rekap/hitung-ikan', ['App\Http\Controllers\RekapController', 'simpanHitungIkan'])->name('rekap.hitung-ikan');
    Route::get('/pemancing/{id_rekap}', ['App\Http\Controllers\RekapController', 'pemancing']);
    Route::get('/jumlah-pemancing/{id_rekap}', ['App\Http\Controllers\RekapController', 'jumlahPemancing'])->name('rekap.jumlah.pemancing');
    Route::post('/detail-rekap/tambah-pemancing', ['App\Http\Controllers\RekapController', 'tambahPemancing'])->name('rekap.tambah.pemancing');
    Route::get('/kocok-lapak-pemancing/{id_rekap}', ['App\Http\Controllers\RekapController', 'kocokLapak']);
    Route::get('/selesai-mancing/{id_pemancing}', ['App\Http\Controllers\RekapController', 'selesaiMancing']);

});

Route::group(['prefix' => 'hadiah-juara'], function () {
    Route::get('/', ['App\Http\Controllers\HadiahJuaraController', 'index'])->name('hadiah-juara.home');
    Route::get('/{jumlah_pemancing}/edit', ['App\Http\Controllers\HadiahJuaraController', 'edit'])->name('hadiah-juara.edit');
    Route::post('/{jumlah_pemancing}/edit', ['App\Http\Controllers\HadiahJuaraController', 'update'])->name('hadiah-juara.update');
});

Route::post('/tambah-tagihan', ['App\Http\Controllers\TagihanPemancingController', 'add']);

Route::get('/kasir',  ['App\Http\Controllers\KasirController', 'index']);
Route::post('/kasir/{id_pemancing}/cetak-struk',  ['App\Http\Controllers\KasirController', 'cetakStruk']);
Route::get('/kasir/{id_pemancing}/detail-tagihan',  ['App\Http\Controllers\KasirController', 'detailTagihan']);

Route::group(['prefix' => 'akun-pengguna'], function () {
    Route::get('/', ['App\Http\Controllers\AkunPenggunaController', 'index']);
    Route::get('/tambah-akun-pengguna', ['App\Http\Controllers\AkunPenggunaController', 'add']);
    Route::get('/check-user-axisting', ['App\Http\Controllers\AkunPenggunaController', 'checkUserAxisting']);
});

Route::get('/halaman-lapak', ['App\Http\Controllers\LapakMancingController', 'index']);
Route::get('/get-halaman-lapak', ['App\Http\Controllers\LapakMancingController', 'getHalamanLapak']);
