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
    Route::get('/edit-barang/{id_barang}', ['App\Http\Controllers\WarungController', 'edit'])->name('warung.edit');
    Route::post('/edit-barang', ['App\Http\Controllers\WarungController', 'update'])->name('warung.update');
    Route::get('/hapus-barang/{id_barang}', ['App\Http\Controllers\WarungController', 'destroy'])->name('warung.destroy');
    Route::get('/barang-option', ['App\Http\Controllers\WarungController', 'getOption']);
});

Route::group(['prefix' => 'rekap-mancing'], function () {
    Route::get('/', ['App\Http\Controllers\RekapController', 'index'])->name('rekap.home');
    Route::get('/tambah-rekap', ['App\Http\Controllers\RekapController', 'create'])->name('rekap.create');
    Route::get('/{id_rekap}/detail-rekap', ['App\Http\Controllers\RekapController', 'detailRekap'])->name('rekap.detail');
    Route::get('/{id_rekap}/detail-rekap/hitung-ikan', ['App\Http\Controllers\RekapController', 'hitungIkan'])->name('rekap.hitung-ikan');
    Route::post('/{id_rekap}/detail-rekap/hitung-ikan', ['App\Http\Controllers\RekapController', 'simpanHitungIkan'])->name('rekap.hitung-ikan');
    Route::get('/{id_rekap}/detail-rekap/hitung-hadiah', ['App\Http\Controllers\RekapController', 'hitungHadiah'])->name('rekap.hitung-hadiah');
    Route::post('/{id_rekap}/detail-rekap/hitung-hadiah', ['App\Http\Controllers\RekapController', 'simpanHitungHadiah'])->name('rekap.hitung-hadiah');
    Route::get('/{id_rekap}/detail-rekap/get-juara/{sesi}', ['App\Http\Controllers\RekapController', 'getJuara'])->name('rekap.get-juara');
    Route::get('/{id_rekap}/detail-rekap/set-hadiah', ['App\Http\Controllers\RekapController', 'setHadiah'])->name('rekap.get-juara');
    Route::get('/pemancing/{id_rekap}', ['App\Http\Controllers\RekapController', 'pemancing']);
    Route::get('/jumlah-pemancing/{id_rekap}', ['App\Http\Controllers\RekapController', 'jumlahPemancing'])->name('rekap.jumlah.pemancing');
    Route::post('/detail-rekap/tambah-pemancing', ['App\Http\Controllers\RekapController', 'tambahPemancing'])->name('rekap.tambah.pemancing');
    Route::get('/kocok-lapak-pemancing/{id_rekap}', ['App\Http\Controllers\RekapController', 'kocokLapak']);
    Route::get('/selesai-mancing/{id_pemancing}', ['App\Http\Controllers\RekapController', 'selesaiMancing']);
    Route::get('/delete-pemancing/{id_pemancing}', ['App\Http\Controllers\RekapController', 'deletePemancing']);

});

Route::group(['prefix' => 'buku-hutang'], function () {
    Route::get('/', ['App\Http\Controllers\BukuHutangController', 'index'])->name('buku-hutang.home');
    Route::post('/bayar', ['App\Http\Controllers\BukuHutangController', 'bayar']);
    Route::post('/bayar-dan-cetak', ['App\Http\Controllers\BukuHutangController', 'bayarDanCetak']);
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
Route::get('/laporan', ['App\Http\Controllers\LaporanController', 'index']);
Route::post('/laporan-get', ['App\Http\Controllers\LaporanController', 'searchData']);
Route::get('/laporan-print', ['App\Http\Controllers\LaporanController', 'printReport']);


Route::get('/profil', ['App\Http\Controllers\ProfilController', 'index'])->name('profil.home');
