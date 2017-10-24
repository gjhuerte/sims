<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplytransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplytransaction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');//before insert trigger
            $table->date('date');//yyyy-mm-dd format                      
            $table->string('stocknumber');
            $table->foreign('stocknumber')->references('stocknumber')->on('supply')
                                        ->onDelete('cascade');
            $table->string('purchaseorderno',100)->nullable();
            $table->foreign('purchaseorderno')->references('purchaseorderno')->on('purchaseorder')
                                                  ->onDelete('cascade');
            $table->string('reference',100);
            $table->string('office',100)->default('N/A');
            $table->integer('receiptquantity')->default('0');//receive
            $table->integer('issuequantity')->default('0');//release
            $table->integer('balancequantity')->default('0'); 
            $table->string('daystoconsume',100)->default('N/A');
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
        Schema::dropIfExists('supplytransaction');
    }
}
