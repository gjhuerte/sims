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
            $table->string('requestor')->nullable();
            $table->foreign('requestor')
                ->references('username')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('office')->nullable();
            $table->foreign('office')
                ->references('code')
                ->on('offices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('issued_by')->nullable();
            $table->foreign('issued_by')
                ->references('username')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('comments')->nullable();
            $table->string('remarks')->nullable();
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
