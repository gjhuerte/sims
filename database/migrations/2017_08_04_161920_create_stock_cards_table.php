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
            $table->foreign('stocknumber')
                    ->references('stocknumber')
                    ->on('supplies')
                    ->onDelete('cascade');
            $table->string('reference',100)->nullable();
            $table->string('receipt',100)->nullable();
            $table->string('organization',100)->nullable();
            $table->integer('received')->default(0);
            $table->integer('issued')->default(0);
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
