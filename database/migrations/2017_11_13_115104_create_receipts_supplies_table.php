<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts_supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receipt_id')->unsigned();
            $table->foreign('receipt_id')
                    ->references('id')
                    ->on('receipts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');        
            $table->integer('supply_id')->unsigned();
            $table->foreign('supply_id')
                    ->references('id')
                    ->on('supplies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('remaining_quantity');
            $table->decimal('unitcost', 8, 2)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('receipts_supplies');
    }
}
