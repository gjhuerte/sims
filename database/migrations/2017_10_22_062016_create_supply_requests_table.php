<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stocknumber');
            $table->foreign('stocknumber')
                    ->references('stocknumber')
                    ->on('supply')
                    ->onDelete('cascade');
            $table->string('request_id');
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
        Schema::dropIfExists('supply_requests');
    }
}
