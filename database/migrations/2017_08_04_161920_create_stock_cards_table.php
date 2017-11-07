<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockcards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->date('date');                   
            $table->string('stocknumber');
            $table->foreign('stocknumber')->references('stocknumber')->on('supply')
                                        ->onDelete('cascade');
            $table->string('purchaseorder_id',100)->nullable();
            $table->string('reference',100);
            $table->string('office',100)->default('N/A');
            $table->integer('receipt')->default('0');
            $table->integer('issued')->default('0');
            $table->integer('balance')->default('0'); 
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
        Schema::dropIfExists('stockcards');
    }
}
