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
            $table->increments('id');
            $table->integer('requests_id')->unsigned();
            $table->foreign('requests_id')
                    ->references('id')
                    ->on('requests')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->text('details');
            $table->integer('comment_by')->unsigned();
            $table->foreign('comment_by')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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
