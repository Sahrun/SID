<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->increments('surat_id');
            $table->string('nama_surat',200);
            $table->dateTime('tanggal');
            $table->string('hal');
            $table->string('surat_filename',200);

            //relationship
            $table->integer('penduduk_id')->nullable()->unsigned();
            $table->foreign('penduduk_id')->references('penduduk_id')->on('penduduk');

            $table->integer('staff_id')->nullable()->unsigned();
            $table->foreign('staff_id')->references('staff_id')->on('staff');
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
        Schema::dropIfExists('surat');
    }
}
