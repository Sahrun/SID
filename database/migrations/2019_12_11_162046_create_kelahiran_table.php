<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelahiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelahiran', function (Blueprint $table) {
            $table->increments('kelahiran_id');
            $table->string('nama_anak',100);
            $table->string('nik_ibu',16);
            $table->string('nik_ayah',16);
            $table->date('dob');
            $table->string('pob',100)->nullable();
            $table->time('tob')->nullable();
            $table->string('hob',100)->nullable();
            $table->enum('kondisi_lahir', ['normal','cacat']);
            $table->integer('berat')->nullable();
            $table->integer('tinggi')->nullable();

             //relationship
            $table->integer('keluarga_id')->nullable()->unsigned();
            $table->foreign('keluarga_id')->references('keluarga_id')->on('keluarga');
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
        Schema::dropIfExists('kelahiran');
    }
}
