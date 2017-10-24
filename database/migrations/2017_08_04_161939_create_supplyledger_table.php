<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplyledgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplyledger', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');//before insert trigger
            $table->date('date');                           
            $table->string('stocknumber');
            $table->foreign('stocknumber')->references('stocknumber')->on('supply')
                                          ->onDelete('cascade');
            $table->string('reference',100);             
            $table->integer('receiptquantity')->default('0');//receive
            $table->decimal('receiptunitprice')->default('0');
            $table->integer('issuequantity')->default('0');//release
            $table->decimal('issueunitprice')->default('0');
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
        Schema::dropIfExists('supplyledger');
    }
}
