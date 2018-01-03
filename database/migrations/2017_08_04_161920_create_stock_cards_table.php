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
            $table->integer('supply_id')->unsigned();
            $table->foreign('supply_id')
                    ->references('id')
                    ->on('supplies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('reference',100)->nullable();
            $table->string('receipt',100)->nullable();
            $table->string('organization',100)->nullable();
            $table->integer('received_quantity')->default(0);
            $table->integer('issued_quantity')->default(0);
            $table->decimal('balance',8,0)->default(0); 
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
