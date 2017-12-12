<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersFundClustersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorders_fundclusters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchaseorder_number',100);
            $table->foreign('purchaseorder_number')
                    ->references('number')
                    ->on('purchaseorders');
            $table->string('fundcluster_code');
            $table->foreign('fundcluster_code')
                    ->references('code')
                    ->on('fundclusters');
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
        Schema::dropIfExists('purchaseorders_fundclusters');
    }
}
