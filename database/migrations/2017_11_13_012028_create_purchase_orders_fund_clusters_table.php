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
            $table->integer('purchaseorder_id')->unsigned();
            $table->foreign('purchaseorder_id')
                    ->references('id')
                    ->on('purchaseorders')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('fundcluster_id')->unsigned();
            $table->foreign('fundcluster_id')
                    ->references('id')
                    ->on('fundclusters')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->primary(['purchaseorder_id', 'fundcluster_id'], 'purchaseorders_fundclusters_primary');
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
