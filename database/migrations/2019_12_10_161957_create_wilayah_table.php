<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah', function (Blueprint $table) {
            $table->increments('wilayah_id');
            $table->integer('wilayah_part')->nullable();
            $table->integer('wilayah_dusun')->nullable();
            $table->integer('wilayah_rw')->nullable();
            $table->integer('wilayah_rt')->nullable();
            $table->string('wilayah_nama')->nullable();
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
        Schema::dropIfExists('wilayah');
    }
}
