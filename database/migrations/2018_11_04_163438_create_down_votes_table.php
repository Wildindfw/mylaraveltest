<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('down_votes', function (Blueprint $table) {
            $table->unsignedInteger('id_users');
            $table->unsignedInteger('id_post');
            $table->primary(['id_users', 'id_post']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('down_votes');
    }
}
