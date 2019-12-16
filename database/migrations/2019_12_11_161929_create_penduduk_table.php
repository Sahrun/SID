<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->increments('penduduk_id');
            $table->string('nik',16);
            $table->string('full_name');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jekel', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('agama')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->enum('status_kependudukan',['Tetap', 'Pendatang','Tidak tetap'])->nullable();

            //relationship
            $table->integer('keluarga_id')->nullable()->unsigned();
            $table->foreign('keluarga_id')->references('keluarga_id')->on('keluarga');

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
        Schema::dropIfExists('penduduk');
    }
}
