<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_name');
            $table->string('user_email')->nullable();
            $table->timestamp('user_email_verified_at')->nullable();
            $table->string('user_password')->nullable();
            $table->string('user_picture')->nullable();
            $table->integer('user_role_id')->unsigned()->nullable();
            $table->foreign('user_role_id')->references('user_role_id')->on('user_role');
            $table->string('api_token', 60)->unique()->nullable();
            
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
