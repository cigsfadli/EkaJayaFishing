<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_tagihan', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi');
            $table->bigInteger('id_pemancing');
            $table->bigInteger('hadiah');
            $table->bigInteger('ikan_garung');
            $table->bigInteger('total_tagihan');
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
        Schema::dropIfExists('transaksi_tagihan');
    }
}
