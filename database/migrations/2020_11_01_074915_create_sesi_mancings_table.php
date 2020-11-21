<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiMancingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesi_mancing', function (Blueprint $table) {
            $table->bigIncrements('id_sesi_mancing');
            $table->bigInteger('id_pemancing');
            $table->bigInteger('id_rekap');
            $table->bigInteger('id_hadiah')->nullable();
            $table->integer('sesi_ke')->default(1);
            $table->integer('lapak');
            $table->integer('jumlah_ikan')->default(0);
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
        Schema::dropIfExists('sesi_mancing');
    }
}
