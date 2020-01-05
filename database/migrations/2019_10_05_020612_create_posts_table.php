<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_users');
            $table->unsignedInteger('subreddit_id');
            $table->text('description');
            $table->string('title');
            $table->text('content');
            $table->unsignedInteger('id_posts');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('subreddit_id')->references('id')->on('posts');

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
