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
            $table->integer('supply_id')->unsigned();
            $table->foreign('supply_id')
                    ->references('id')
                    ->on('supplies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('request_id')->unsigned();
            $table->foreign('request_id')
                    ->references('id')
                    ->on('requests')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('quantity_requested')->default(0);
            $table->integer('quantity_issued')->nullable();
            $table->integer('quantity_released')->nullable();
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
