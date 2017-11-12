<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number',100)->unique();
            $table->string('status')->nullable();
            $table->date('date_received');
            $table->string('fundcluster')->nullable();
            $table->string('details')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')
                    ->references('id')
                    ->on('suppliers');
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
        Schema::dropIfExists('purchaseorders');
    }
}
