<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgerCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgercards', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');                   
            $table->integer('supply_id')->unsigned();
            $table->foreign('supply_id')
                    ->references('id')
                    ->on('supplies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('reference',100)->nullable();
            $table->string('receipt')->nullable();             
            $table->integer('received_quantity')->default(0);
            $table->decimal('received_unitcost')->default(0);
            $table->integer('issued_quantity')->default(0);
            $table->decimal('issued_unitcost')->default(0);
            $table->decimal('balance_quantity',8,0)->default(0); 
            $table->string('daystoconsume',100)->default('N/A');
            $table->string('created_by');
            $table->timestamps();

            /**
             * added index in the migration
             * if problems persists
             * remove the files below the comment
             * added on 01/15/2018
             */
            $table->index('date');
            $table->index('received_quantity');
            $table->index('issued_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledgercards');
    }
}
