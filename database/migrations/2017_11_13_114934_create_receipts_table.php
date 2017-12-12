<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference');
            $table->string('number')->unique();
            $table->string('invoice')->nullable();
            $table->datetime('date_delivered')->nullable();
            $table->string('received_by')->nullable();
            $table->string('supplier_name',100)->nullable();
            $table->foreign('supplier_name')
                    ->references('name')
                    ->on('suppliers');
            $table->softDeletes();
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
        Schema::dropIfExists('receipts');
    }
}
