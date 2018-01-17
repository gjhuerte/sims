<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('local')->nullable();
            $table->integer('requestor_id')->unsigned()->nullable();
            $table->foreign('requestor_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('office_id')->unsigned()->nullable();
            $table->foreign('office_id')
                ->references('id')
                ->on('offices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('issued_by')->unsigned()->nullable();
            $table->foreign('issued_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('remarks')->nullable();
            $table->string('purpose')->nullable();
            $table->string('status')->nullable();
            $table->string('released_by')->nullable();
            $table->datetime('released_at')->nullable();
            $table->datetime('approved_at')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->datetime('cancelled_at')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
