<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendudukPindahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk_pindah', function (Blueprint $table) {
            $table->increments('pindah_id');
            $table->dateTime('tgl_pindah');
            $table->string('alamat_pindah',100);
            $table->string('alasan_pindah',100);

            //relationship
            $table->integer('penduduk_id')->nullable()->unsigned();
            $table->foreign('penduduk_id')->references('penduduk_id')->on('penduduk');
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
        Schema::dropIfExists('penduduk_pindah');
    }
}
