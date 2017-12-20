<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundclustersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundclusters_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fundcluster_code');
            $table->foreign('fundcluster_code')
                    ->references('code')
                    ->on('fundclusters')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('category_name');
            $table->foreign('category_name')
                    ->references('name')
                    ->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('ris_start')->nullable();
            $table->string('ris_end')->nullable();
            $table->date('date_issued');
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('fundclusters_categories');
    }
}
