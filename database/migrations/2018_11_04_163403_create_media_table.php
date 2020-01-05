<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_users');
            $table->unsignedInteger('id_posts');
            $table->char('type', 1); //P: photo or V: video
            $table->string('file');
            $table->timestamps();


            $table->foreign('id_posts')->references('id')->on('posts');
            $table->foreign('id_users')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
