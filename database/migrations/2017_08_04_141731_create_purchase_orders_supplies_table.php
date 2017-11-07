<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorders_supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchaseorder_id',100);
            $table->foreign('purchaseorder_id')
                    ->references('purchaseorderno')
                    ->on('purchaseorder')
                    ->onDelete('cascade');
            $table->string('reference',100)->nullable();
            $table->string('date',100)->nullable();
            $table->string('stocknumber',100);
            $table->decimal('unitprice')->default('0');
            $table->integer('orderedquantity');
            $table->integer('receivedquantity')->default('0');
            $table->integer('issuedquantity')->default('0');
            $table->integer('remainingquantity')->setDefault(0);
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('purchaseorders_supplies');
    }
}
