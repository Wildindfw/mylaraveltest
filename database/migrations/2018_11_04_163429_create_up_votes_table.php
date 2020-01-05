<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('up_votes', function (Blueprint $table) {
            $table->unsignedInteger('id_users');
            $table->unsignedInteger('id_post');
            $table->primary(['id_users', 'id_posts']);

            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_posts')->references('id')->on('posts');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('up_votes');
    }
}
