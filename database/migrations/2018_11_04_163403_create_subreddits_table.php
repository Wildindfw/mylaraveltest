<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubredditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subreddits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('handle')->unique();
            $table->string('description');
            $table->string('icon')->default('https://assets.pcmag.com/media/images/391545-reddit-logo.jpg?thumb=y&width=275&height=275');
            $table->string('banner');
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
        Schema::dropIfExists('subreddits');
    }
}
