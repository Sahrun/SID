<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->increments('keluarga_id');
            $table->string('no_kk',16);
            $table->longText('alamat_keluarga');
            $table->string('hubungan',50);

            //relationship
            $table->integer('wilayah_id')->nullable()->unsigned();
            $table->foreign('wilayah_id')->references('wilayah_id')->on('wilayah');
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
        Schema::dropIfExists('keluarga');
    }
}
