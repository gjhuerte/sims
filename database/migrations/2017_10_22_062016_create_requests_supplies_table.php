<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stocknumber');
            $table->foreign('stocknumber')
                    ->references('stocknumber')
                    ->on('supplies')
                    ->onDelete('cascade');
            $table->integer('request_id')->unsigned();
            $table->foreign('request_id')
                    ->references('id')
                    ->on('requests')
                    ->onDelete('cascade');
            $table->integer('quantity_requested')
                    ->setDefault('1');
            $table->integer('quantity_issued')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('requests_supplies');
    }
}
