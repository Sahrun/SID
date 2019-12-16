<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendatangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendatang', function (Blueprint $table) {
            $table->Increments('pendatang_id');
            $table->dateTime('tgl_datang');
            $table->string('alamat_datang',100);
            $table->string('alasan_datang',100);

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
        Schema::dropIfExists('pendatang');
    }
}
