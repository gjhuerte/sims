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
            $table->string('receipt_number');
            $table->foreign('receipt_number')
                    ->references('number')
                    ->on('receipts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('stocknumber');
            $table->foreign('stocknumber')
                    ->references('stocknumber')
                    ->on('supplies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('remaining_quantity');
            $table->float('cost')->nullable();
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
