<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchaseorder_id')->unsigned()->nullable();
            $table->foreign('purchaseorder_id')
                    ->references('id')
                    ->on('purchaseorders')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('number')->unique();
            $table->string('invoice')->nullable();
            $table->datetime('invoice_date')->nullable();
            $table->datetime('date_delivered')->nullable();
            $table->string('received_by')->nullable();
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')
                    ->references('id')
                    ->on('suppliers')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('receipts');
    }
}
