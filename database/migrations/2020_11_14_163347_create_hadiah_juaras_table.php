<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHadiahJuarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadiah_juara', function (Blueprint $table) {
            $table->bigIncrements('id_hadiah_juara');
            $table->integer('jumlah_pemancing');
            $table->integer('juara_ke');
            $table->integer('hadiah')->nullable();
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
        Schema::dropIfExists('hadiah_juara');
    }
}
