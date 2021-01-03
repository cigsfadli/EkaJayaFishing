<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempHitungIkansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_hitung_ikan', function (Blueprint $table) {
            $table->bigIncrements('id_temp_hitung_ikan');
            $table->bigInteger('id_pemancing');
            $table->bigInteger('id_rekap');
            $table->bigInteger('hadiah')->default(0);
            $table->integer('sesi_ke')->default(1);
            $table->integer('lapak');
            $table->integer('jumlah_ikan')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_hitung_ikan');
    }
}
