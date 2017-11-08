<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_comments', function (Blueprint $table) {
            $table->increments();
            $table->string('requests_id');
            $table->foreign('requests_id')
                    ->references('id')
                    ->on('requests');
            $table->string('details');
            $table->integer('comment_by')->unsigned();
            $table->foreign('comment_by')
                    ->references('id')
                    ->on('users');
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
        Schema::dropIfExists('requests_comments');
    }
}
