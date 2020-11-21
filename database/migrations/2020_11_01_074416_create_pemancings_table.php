<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemancingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemancing', function (Blueprint $table) {
            $table->bigIncrements('id_pemancing');
            $table->unsignedBigInteger('id_rekap');
            $table->string('nama_pemancing', 100);
            $table->enum('status', ['masih mancing', 'selesai'])->default('masih mancing');
            $table->enum('ganjil_genap', ['ganjil', 'genap'])->nullable();
            $table->integer('lapak_sekarang')->nullable();
            $table->integer('total_sesi')->default(0);
            $table->enum('status_tagihan', ['sudah bayar', 'belum bayar'])->default('belum bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemancing');
    }
}
