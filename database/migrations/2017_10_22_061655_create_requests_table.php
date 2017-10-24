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
            $table->string('id')->primary();
            $table->string('requestor');
            $table->foreign('requestor')
                ->references('username')
                ->on('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('issued_by')->nullable();
            $table->foreign('issued_by')
                ->references('username')
                ->on('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('remarks')->nullable();
            $table->string('status')->nullable();
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
