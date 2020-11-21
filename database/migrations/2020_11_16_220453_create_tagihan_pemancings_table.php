<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanPemancingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan_pemancing', function (Blueprint $table) {
            $table->bigIncrements('id_tagihan_pemancing');
            $table->bigInteger('id_pemancing');
            $table->bigInteger('id_barang');
            $table->integer('jumlah');
            $table->enum('status', ['sudah dibayar', 'belum dibayar'])->default('belum dibayar');
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
        Schema::dropIfExists('tagihan_pemancing');
    }
}
