<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchaseorder_number',100);
            $table->date('date_received');
            $table->string('receipt_number');
            $table->string('invoice')->nullable();
            $table->datetime('invoice_date')->nullable();
            $table->datetime('date_delivered')->nullable();
            $table->string('supplier')->nullable();
            $table->string('verified_by')->nullable();
            $table->datetime('verified_on')->nullable();
            $table->string('received_by')->nullable();
            $table->string('adjusted_by')->nullable();
            $table->datetime('adjusted_on')->nullable();
            $table->string('finalized_by')->nullable();
            $table->datetime('finalized_on')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('inspections');
    }
}
