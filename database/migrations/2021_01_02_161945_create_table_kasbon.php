<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKasbon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatan_kasbon', function (Blueprint $table) {
            $table->bigIncrements('id_kasbon');
            $table->string('nama_pemancing', 100)->default('text');
            $table->bigInteger('total_kasbon')->default(0);
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
        Schema::dropIfExists('catatan_kasbon');
    }
}
