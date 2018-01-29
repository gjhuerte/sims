<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRsmiStockcardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rsmi_stockcard', function (Blueprint $table) {
            $table->integer('rsmi_id')->unsigned();
            $table->foreign('rsmi_id')
                    ->references('id')
                    ->on('rsmi')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('stockcard_id')->unsigned();
            $table->foreign('stockcard_id')
                    ->references('id')
                    ->on('stockcards')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('ledgercard_id')->unsigned()->nullable();
            $table->foreign('ledgercard_id')
                    ->references('id')
                    ->on('ledgercards')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('uacs_code')->nullable();
            $table->float('unitcost', 8, 2)->nullable();
            $table->primary([ 'rsmi_id', 'stockcard_id']);
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
        Schema::dropIfExists('rsmi_stockcard');
    }
}
