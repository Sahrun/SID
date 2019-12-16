<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKematianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kematian', function (Blueprint $table) {
            $table->increments('kematian_id');
            $table->date('tgl_kematian');
            $table->time('jam_kematian');
            $table->string('tempat_kematian',100);
            $table->enum('sebab_kematian', ['Usia Tua', 'Sakit', 'Lainnya']);

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
        Schema::dropIfExists('kematian');
    }
}
