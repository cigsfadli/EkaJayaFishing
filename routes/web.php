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
});

Route::group(['prefix' => 'warung'], function () {
    Route::get('/', ['App\Http\Controllers\WarungController', 'index'])->name('warung.home');
    Route::get('/tambah-barang', ['App\Http\Controllers\WarungController', 'add'])->name('warung.add');
    Route::post('/tambah-barang', ['App\Http\Controllers\WarungController', 'create'])->name('warung.create');
});

Route::group(['prefix' => 'rekap-mancing'], function () {
    Route::get('/', ['App\Http\Controllers\RekapController', 'index'])->name('rekap.home');
    Route::get('/tambah-rekap', ['App\Http\Controllers\RekapController', 'create'])->name('rekap.create');
});