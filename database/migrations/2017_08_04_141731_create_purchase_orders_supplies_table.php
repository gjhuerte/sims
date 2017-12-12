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
            $table->string('purchaseorder_number',100);
            $table->foreign('purchaseorder_number')
                    ->references('number')
                    ->on('purchaseorders')
                    ->onDelete('cascade');
            $table->string('reference',100)->nullable();
            $table->string('date',100)->nullable();
            $table->string('stocknumber',100);
            $table->decimal('unitcost')->default(0);
            $table->integer('orderedquantity');
            $table->integer('receivedquantity')->default(0);
            $table->integer('remainingquantity')->default(0);
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
