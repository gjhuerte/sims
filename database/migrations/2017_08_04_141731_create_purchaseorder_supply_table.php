<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseorderSupplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorder_supply', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',100);//before insert trigger
            $table->string('purchaseorderno',100);
            $table->foreign('purchaseorderno')->references('purchaseorderno')->on('purchaseorder')
                                                  ->onDelete('cascade');
            $table->string('reference',100)->nullable();
            $table->string('date',100)->nullable();
            $table->string('supplyitem',100);
            $table->integer('orderedquantity');
            $table->integer('receivedquantity')->default('0');
            $table->integer('issuedquantity')->default('0');
            $table->decimal('unitprice')->default('0');
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
        // Schema::dropIfExists('purchaseorder_supply');
    }
}
